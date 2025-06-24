<template>
    <MyAppLayout>
        <div class="h-full bg-gray-900 overflow-auto cyber-bg">
            <div class="bg-black/80 shadow-lg border-b border-green-500/30 px-6 py-4 backdrop-blur-sm">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-green-400 cyber-glow font-mono">
                            &gt; MES_NOTES.exe
                        </h1>
                        <span class="ml-3 text-sm text-cyan-400 font-mono bg-gray-800/50 px-2 py-1 rounded border border-cyan-500/30">
                            [{{ notes.length }} note{{ notes.length > 1 ? 's' : '' }}]
                        </span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input v-model="searchQuery" type="text" placeholder="search://query..."
                                class="w-64 px-4 py-2 pl-10 pr-4 text-sm bg-gray-800/80 border border-cyan-500/50 rounded text-green-300 placeholder-gray-500 focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 focus:bg-gray-800 transition-all font-mono">
                            <svg class="absolute left-3 top-2.5 h-4 w-4 text-cyan-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <Link href="/app"
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-cyan-600 text-black text-sm font-bold rounded border border-green-400 hover:from-green-500 hover:to-cyan-500 transition-all cyber-button font-mono shadow-lg shadow-green-500/25">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        + NEW_FILE
                        </Link>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div v-if="filteredNotes.length === 0 && searchQuery === ''" class="text-center py-12">
                    <div class="terminal-window bg-gray-800/50 border border-green-500/30 rounded-lg p-6 max-w-md mx-auto">
                        <div class="terminal-header bg-gray-900/80 -m-6 mb-4 p-3 rounded-t-lg border-b border-green-500/30">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                <span class="ml-2 text-xs text-gray-400 font-mono">~/notes/</span>
                            </div>
                        </div>
                        <div class="font-mono text-green-400 text-left">
                            <div class="text-cyan-400">$ ls -la notes/</div>
                            <div class="text-gray-500 mt-2">total 0</div>
                            <div class="text-red-400 mt-2 blink">ERROR: No files found</div>
                            <div class="text-green-400 mt-4">$ echo "Initialize first note?"</div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <Link href="/notes/create"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-cyan-600 text-black font-bold rounded border border-green-400 hover:from-green-500 hover:to-cyan-500 transition-all cyber-button font-mono shadow-lg shadow-green-500/25">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        INIT_NOTE.sh
                        </Link>
                    </div>
                </div>

                <div v-else-if="filteredNotes.length === 0 && searchQuery !== ''" class="text-center py-12">
                    <div class="terminal-window bg-gray-800/50 border border-red-500/30 rounded-lg p-6 max-w-md mx-auto">
                        <div class="font-mono text-red-400">
                            <div class="text-cyan-400">$ grep -r "{{ searchQuery }}" notes/</div>
                            <div class="text-red-400 mt-2 blink">grep: No matches found</div>
                            <div class="text-gray-500 mt-2">Exit code: 1</div>
                        </div>
                    </div>
                    <button @click="searchQuery = ''"
                        class="mt-4 text-cyan-400 hover:text-cyan-300 text-sm font-mono border border-cyan-500/30 px-3 py-1 rounded hover:border-cyan-400 transition-all">
                        $ clear && reset
                    </button>
                </div>

                <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <div v-for="note in filteredNotes" :key="note.id"
                        class="bg-gray-800/60 rounded-lg border border-gray-700/50 hover:border-green-500/50 transition-all duration-300 cursor-pointer group cyber-card backdrop-blur-sm"
                        @click="goToNote(note.id)">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <div class="text-xs text-gray-500 font-mono mb-1">
                                        note_{{ String(note.id).padStart(2, '0') }}-{{ note.title }}.md
                                    </div>
                                    <h3 class="text-lg font-semibold text-green-400 group-hover:text-cyan-400 transition-colors line-clamp-2 font-mono">
                                        {{ note.title || '> untitled.note' }}
                                    </h3>
                                </div>
                                <div class="flex space-x-1 opacity-0 group-hover:opacity-100 transition-opacity ml-2">
                                    <button @click.stop="editNote(note.id)"
                                        class="p-1 text-gray-500 hover:text-cyan-400 rounded hover:bg-gray-700/50 transition-all" title="vim edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button @click.stop="deleteNote(note.id)"
                                        class="p-1 text-gray-500 hover:text-red-400 rounded hover:bg-gray-700/50 transition-all" title="rm -rf">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="text-gray-300 text-sm mb-4 line-clamp-3 font-mono bg-gray-900/30 p-3 rounded border-l-2 border-green-500/30">
                                {{ getPreview(note.content) }}
                            </div>

                            <div class="flex items-center justify-between text-xs text-gray-500 font-mono">
                                <span class="flex items-center bg-gray-900/40 px-2 py-1 rounded border border-gray-700/50">
                                    <svg class="w-3 h-3 mr-1 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    {{ getWordCount(note.content) }}w
                                </span>
                                <span class="text-green-500">●</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MyAppLayout>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import MyAppLayout from '@/layouts/MyAppLayout.vue';

interface Note {
    id: number;
    title?: string;
    content?: string;
}

interface Props {
    notes: Note[];
}

const props = defineProps<Props>();

const searchQuery = ref('');

const filteredNotes = computed(() => {
    if (!searchQuery.value) return props.notes;

    const query = searchQuery.value.toLowerCase();
    return props.notes.filter(note =>
        (note.title?.toLowerCase().includes(query)) ||
        (note.content?.toLowerCase().includes(query))
    );
});

const getPreview = (content?: string) => {
    if (!content) return '// No content found';
    const cleanContent = content
        .replace(/#{1,6}\s+/g, '')
        .replace(/\*\*(.*?)\*\*/g, '$1')
        .replace(/\*(.*?)\*/g, '$1')
        .replace(/`(.*?)`/g, '$1')
        .replace(/\n/g, ' ')
        .trim();

    return cleanContent.length > 150
        ? cleanContent.substring(0, 150) + '...'
        : cleanContent;
};

const getWordCount = (content?: string) => {
    if (!content) return 0;
    return content.trim().split(/\s+/).filter(word => word.length > 0).length;
};

const goToNote = (id: number) => {
    router.visit(`/app/${id}`);
};

const editNote = (id: number) => {
    router.visit(`/app/${id}`);
};

const deleteNote = (id: number) => {
    if (confirm('$ rm -rf note.md? [y/N]')) {
        router.delete(`/notes/${id}`, {
            onSuccess: () => {
            }
        });
    }
};
</script>

<style scoped>
/* Fond cyberpunk animé */
.cyber-bg {
    background: 
        radial-gradient(circle at 20% 80%, rgba(0, 255, 135, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(0, 191, 255, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(0, 255, 135, 0.02) 0%, transparent 50%),
        #0f1419;
    position: relative;
}

.cyber-bg::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        linear-gradient(45deg, transparent 48%, rgba(0, 255, 135, 0.01) 49%, rgba(0, 255, 135, 0.01) 51%, transparent 52%),
        linear-gradient(-45deg, transparent 48%, rgba(0, 191, 255, 0.01) 49%, rgba(0, 191, 255, 0.01) 51%, transparent 52%);
    background-size: 20px 20px;
    pointer-events: none;
    z-index: 0;
}

/* Effet néon pour le titre principal */
.cyber-glow {
    text-shadow: 
        0 0 5px currentColor,
        0 0 10px currentColor,
        0 0 15px currentColor;
}

/* Boutons avec effet cyber */
.cyber-button {
    position: relative;
    overflow: hidden;
    text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    box-shadow: 
        0 0 10px rgba(0, 255, 135, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

.cyber-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.cyber-button:hover::before {
    left: 100%;
}

/* Cartes avec effet holographique subtil */
.cyber-card {
    position: relative;
    background: 
        linear-gradient(135deg, rgba(31, 41, 55, 0.6) 0%, rgba(17, 24, 39, 0.6) 100%);
    box-shadow: 
        0 4px 15px rgba(0, 0, 0, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.05);
}

.cyber-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(0, 255, 135, 0.03) 50%, transparent 70%);
    opacity: 0;
    transition: opacity 0.3s;
    border-radius: inherit;
    pointer-events: none;
}

.cyber-card:hover::before {
    opacity: 1;
}

.cyber-card:hover {
    transform: translateY(-2px);
    box-shadow: 
        0 8px 25px rgba(0, 0, 0, 0.4),
        0 0 20px rgba(0, 255, 135, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

/* Fenêtre terminal */
.terminal-window {
    box-shadow: 
        0 10px 30px rgba(0, 0, 0, 0.5),
        inset 0 1px 0 rgba(0, 255, 135, 0.1);
}

/* Animation clignotante */
@keyframes blink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0.3; }
}

.blink {
    animation: blink 1.5s infinite;
}

/* Amélioration des line-clamp */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Scrollbar cyber */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(17, 24, 39, 0.5);
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #10b981, #06b6d4);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #059669, #0891b2);
}

/* Effet de focus sur les inputs */
input:focus {
    box-shadow: 
        0 0 0 2px rgba(6, 182, 212, 0.3),
        0 0 10px rgba(6, 182, 212, 0.2);
}
</style>