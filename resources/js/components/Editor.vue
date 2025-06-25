<script setup lang="ts">

import Editor from '@toast-ui/editor';
import '@toast-ui/editor/dist/toastui-editor.css';
import uml from '@toast-ui/editor-plugin-uml';

import { onMounted, ref, defineModel } from 'vue';
import { useToastUICustomTitleInput } from '@/editorComponents/titleInput';

const props = defineProps({
    title: String,
});

const emits = defineEmits(['titleUpdated', 'tagsUpdated']);


onMounted(() => {
    refTitle.value = props.title ?? ''
});





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
                el: useToastUICustomTitleInput({
                    onUpdate(a) {
                        markdownContent.value = a;
                        emits("titleUpdated", a);
                    },
                }),
                tooltip: 'Titre de note'
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