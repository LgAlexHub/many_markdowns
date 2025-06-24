<script setup lang="ts">

import Editor from '@toast-ui/editor';
import '@toast-ui/editor/dist/toastui-editor.css';
import uml from '@toast-ui/editor-plugin-uml';

import { onMounted, ref, defineModel, reactive } from 'vue';

const props = defineProps({
    title: String,
});

const emits = defineEmits(['titleUpdated', 'tagsUpdated']);
const titleInputElement = ref<HTMLInputElement | null>(null);
const tagSelectorElement = ref<HTMLDivElement | null>(null);

// État pour les tags
const tagState = reactive({
    searchTerm: '',
    availableTags: [] as Array<{id: number, label: string, color: string}>,
    selectedTags: [] as Array<{id: number, label: string, color: string}>,
    isDropdownOpen: false,
    isLoading: false
});

onMounted(() => {
    refTitle.value = props.title ?? ''
});

const searchTags = async (searchTerm: string) => {
    console.log('pipi')
    if (searchTerm.length < 2) {
        tagState.availableTags = [];
        return;
    }

    tagState.isLoading = true;
    try {
        // Remplacez par votre endpoint Laravel
        const response = await fetch(`/api/tags?query=${encodeURIComponent(searchTerm)}`);
        const data = await response.json();
        tagState.availableTags = data.tags || [];
    } catch (error) {
        console.error('Erreur lors de la recherche de tags:', error);
        tagState.availableTags = [];
    } finally {
        tagState.isLoading = false;
    }
};

// Fonction pour sélectionner un tag
const selectTag = (tag: {id: number, label: string, color: string}) => {
    // Vérifier si le tag n'est pas déjà sélectionné
    const isAlreadySelected = tagState.selectedTags.some(t => t.id === tag.id);
    if (!isAlreadySelected) {
        tagState.selectedTags.push(tag);
        emits('tagsUpdated', tagState.selectedTags);
    }
    
    // Fermer la dropdown et vider la recherche
    tagState.isDropdownOpen = false;
    tagState.searchTerm = '';
    tagState.availableTags = [];
    
    // Mettre à jour l'input
    if (tagSelectorElement.value) {
        const input = tagSelectorElement.value.querySelector('input') as HTMLInputElement;
        if (input) input.value = '';
    }
};

// Fonction pour supprimer un tag sélectionné
const removeTag = (tagId: number) => {
    tagState.selectedTags = tagState.selectedTags.filter(t => t.id !== tagId);
    emits('tagsUpdated', tagState.selectedTags);
};

const createTagSelector = () => {
    const container = document.createElement('div');
    container.style.position = 'relative';
    container.style.minWidth = '250px';
    container.className = 'tag-selector-container';
    
    // Input de recherche
    const searchInput = document.createElement('input');
    searchInput.setAttribute('type', 'text');
    searchInput.setAttribute('placeholder', 'Rechercher des tags...');
    searchInput.className = 'toastui-editor-toolbar-icons bg-white text-black rounded-sm border-2 px-2 border-slate-200';
    searchInput.style.backgroundImage = 'none';
    searchInput.style.margin = '0';
    searchInput.style.width = '100%';
    
    // Container pour les tags sélectionnés
    const selectedTagsContainer = document.createElement('div');
    selectedTagsContainer.className = 'selected-tags';
    selectedTagsContainer.style.cssText = `
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-top: 4px;
        max-width: 250px;
    `;
    
    // Dropdown pour les résultats
    const dropdown = document.createElement('div');
    dropdown.className = 'tags-dropdown';
    dropdown.style.cssText = `
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
    `;
    
    // Fonction pour mettre à jour l'affichage des tags sélectionnés
    const updateSelectedTagsDisplay = () => {
        selectedTagsContainer.innerHTML = '';
        tagState.selectedTags.forEach(tag => {
            const tagElement = document.createElement('span');
            tagElement.className = 'selected-tag';
            tagElement.style.cssText = `
                background: ${tag.color};
                color: white;
                padding: 2px 8px;
                border-radius: 12px;
                font-size: 12px;
                display: flex;
                align-items: center;
                gap: 4px;
                text-shadow: 0 1px 2px rgba(0,0,0,0.3);
            `;
            
            const tagText = document.createElement('span');
            tagText.textContent = tag.label;
            
            const removeBtn = document.createElement('button');
            removeBtn.textContent = '×';
            removeBtn.style.cssText = `
                background: none;
                border: none;
                color: white;
                cursor: pointer;
                font-size: 14px;
                padding: 0;
                margin: 0;
                line-height: 1;
            `;
            removeBtn.onclick = (e) => {
                e.stopPropagation();
                removeTag(tag.id);
                updateSelectedTagsDisplay();
            };
            
            tagElement.appendChild(tagText);
            tagElement.appendChild(removeBtn);
            selectedTagsContainer.appendChild(tagElement);
        });
    };
    
    // Fonction pour mettre à jour la dropdown
    const updateDropdown = () => {
        dropdown.innerHTML = '';
        
        if (tagState.isLoading) {
            const loadingItem = document.createElement('div');
            loadingItem.textContent = 'Recherche en cours...';
            loadingItem.style.padding = '8px 12px';
            dropdown.appendChild(loadingItem);
        } else if (tagState.availableTags.length === 0 && tagState.searchTerm.length >= 2) {
            const noResultItem = document.createElement('div');
            noResultItem.textContent = 'Aucun tag trouvé';
            noResultItem.style.padding = '8px 12px';
            noResultItem.style.color = '#666';
            dropdown.appendChild(noResultItem);
        } else {
            tagState.availableTags.forEach(tag => {
                const tagItem = document.createElement('div');
                tagItem.style.cssText = `
                    padding: 8px 12px;
                    cursor: pointer;
                    border-bottom: 1px solid #eee;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                `;
                
                // Indicateur de couleur
                const colorIndicator = document.createElement('span');
                colorIndicator.style.cssText = `
                    width: 12px;
                    height: 12px;
                    border-radius: 50%;
                    background-color: ${tag.color};
                    flex-shrink: 0;
                `;
                
                // Texte du label
                const labelText = document.createElement('span');
                labelText.textContent = tag.label;
                
                tagItem.appendChild(colorIndicator);
                tagItem.appendChild(labelText);
                
                tagItem.onmouseenter = () => {
                    tagItem.style.backgroundColor = '#f5f5f5';
                };
                tagItem.onmouseleave = () => {
                    tagItem.style.backgroundColor = 'white';
                };
                tagItem.onclick = () => selectTag(tag);
                dropdown.appendChild(tagItem);
            });
        }
        
        dropdown.style.display = tagState.isDropdownOpen && (tagState.availableTags.length > 0 || tagState.isLoading || tagState.searchTerm.length >= 2) ? 'block' : 'none';
    };
    
    // Event listeners
    let searchTimeout: number;
    searchInput.oninput = (e) => {
        const target = e.target as HTMLInputElement;
        tagState.searchTerm = target.value;
        tagState.isDropdownOpen = true;
        
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            searchTags(tagState.searchTerm);
        }, 300);
    };
    
    searchInput.onfocus = () => {
        if (tagState.searchTerm.length >= 2) {
            tagState.isDropdownOpen = true;
        }
    };
    
    // Fermer la dropdown quand on clique ailleurs
    document.addEventListener('click', (e) => {
        if (!container.contains(e.target as Node)) {
            tagState.isDropdownOpen = false;
            updateDropdown();
        }
    });
    
    // Watcher pour les changements d'état
    const updateUI = () => {
        updateSelectedTagsDisplay();
        updateDropdown();
    };
    
    // Observer les changements d'état
    const observer = new MutationObserver(updateUI);
    observer.observe(document.body, { childList: true, subtree: true });
    
    // Surveiller les changements d'état manuellement
    setInterval(updateUI, 100);
    
    container.appendChild(searchInput);
    container.appendChild(selectedTagsContainer);
    container.appendChild(dropdown);
    
    tagSelectorElement.value = container;
    return container;
};

const createLastButton = () => {
    titleInputElement.value = document.createElement('input')
    titleInputElement.value.setAttribute("type", "text");
    titleInputElement.value.setAttribute("placeholder", "Titre de la note")
    titleInputElement.value.value = refTitle.value;
    titleInputElement.value.className = 'toastui-editor-toolbar-icons bg-white text-black rounded-sm border-2 px-2 border-slate-200';
    titleInputElement.value.style.backgroundImage = 'none';
    titleInputElement.value.style.margin = '0';
    titleInputElement.value.addEventListener('keypress', () => {
        refTitle.value = titleInputElement.value!.value;
        emits("titleUpdated", refTitle.value);
    });
    return titleInputElement.value;
}

onMounted(() => {
    editor.value = new Editor({
        width: '100%',
        plugins: [uml],
        height: '100dvh',
        previewStyle: 'vertical',
        initialEditType: 'markdown',
        el: document.querySelector('#editor'),
        initialValue: markdownContent.value,
        theme: 'dark',
        toolbarItems: [
            [{
                el: createLastButton(),
                tooltip: 'Titre de note'
            }],
            [{
                el: createTagSelector(),
                tooltip: 'Sélectionner des tags'
            }],
            ['heading', 'bold', 'italic', 'strike'],
            ['hr', 'quote'],
            ['ul', 'ol', 'task', 'indent', 'outdent'],
            ['table', 'image', 'link'],
            ['code', 'codeblock'],
        ]
    });

    editor.value.on('change', () => markdownContent.value = editor.value.getMarkdown());
});

const markdownContent = defineModel();
const refTitle = ref("");
const editor = ref();
</script>

<template>
    <div id="editor" class="bg-white"></div>
</template>

<style>
.tag-selector-container .selected-tag:hover button {
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
}

.tags-dropdown::-webkit-scrollbar {
    width: 6px;
}

.tags-dropdown::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.tags-dropdown::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.tags-dropdown::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>