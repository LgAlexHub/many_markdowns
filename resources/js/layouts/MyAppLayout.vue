<template>
    <div class="nav-layout h-full">
        <aside class="h-full bg-gray-900/95 border-r border-green-500/30 backdrop-blur-sm cyber-sidebar">
            <div class="p-6 border-b border-green-500/20">
                <div class="text-center">
                    <div class="text-lg font-bold text-green-400 cyber-glow font-mono mb-2">
                        &gt; SYSTEM_NAV
                    </div>
                    <div
                        class="text-xs text-cyan-400 font-mono bg-gray-800/50 px-2 py-1 rounded border border-cyan-500/30">
                        [ONLINE]
                    </div>
                </div>
            </div>

            <nav class="p-4 space-y-2">
                <a href="/notes"
                    class="nav-item group flex items-center p-3 rounded-lg transition-all duration-300 font-mono text-sm"
                    :class="isActive('/notes') ? 'bg-gradient-to-r from-green-600/20 to-cyan-600/20 border border-green-500/50 text-green-300' : 'text-gray-400 hover:text-green-300 hover:bg-gray-800/50 border border-transparent hover:border-green-500/30'">
                    <div class="cyber-icon-container">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4" />
                        </svg>
                    </div>
                    <span>~/notes</span>
                    <div class="ml-auto text-xs opacity-0 group-hover:opacity-100 transition-opacity text-cyan-400">
                        [ENTER]
                    </div>
                </a>

                <a href="/app"
                    class="nav-item group flex items-center p-3 rounded-lg transition-all duration-300 font-mono text-sm"
                    :class="isActive('/notes/create') ? 'bg-gradient-to-r from-green-600/20 to-cyan-600/20 border border-green-500/50 text-green-300' : 'text-gray-400 hover:text-green-300 hover:bg-gray-800/50 border border-transparent hover:border-green-500/30'">
                    <div class="cyber-icon-container">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <span>new_file.md</span>
                    <div class="ml-auto text-xs opacity-0 group-hover:opacity-100 transition-opacity text-cyan-400">
                        [CTRL+N]
                    </div>
                </a>

                <a href="/notes/archive"
                    class="nav-item group flex items-center p-3 rounded-lg transition-all duration-300 font-mono text-sm"
                    :class="isActive('/notes/archive') ? 'bg-gradient-to-r from-green-600/20 to-cyan-600/20 border border-green-500/50 text-green-300' : 'text-gray-400 hover:text-green-300 hover:bg-gray-800/50 border border-transparent hover:border-green-500/30'">
                    <div class="cyber-icon-container">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l6 6 6-6" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4h18v2H3zM3 18h18v2H3z" />
                        </svg>
                    </div>
                    <span>./archive</span>
                    <div class="ml-auto text-xs opacity-0 group-hover:opacity-100 transition-opacity text-cyan-400">
                        [ALT+A]
                    </div>
                </a>

                <div class="my-4 border-t border-gray-700/50 relative">
                    <div class="absolute inset-0 border-t border-green-500/10"></div>
                </div>

                <a href="/settings"
                    class="nav-item group flex items-center p-3 rounded-lg transition-all duration-300 font-mono text-sm"
                    :class="isActive('/settings') ? 'bg-gradient-to-r from-green-600/20 to-cyan-600/20 border border-green-500/50 text-green-300' : 'text-gray-400 hover:text-green-300 hover:bg-gray-800/50 border border-transparent hover:border-green-500/30'">
                    <div class="cyber-icon-container">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span>config.sys</span>
                    <div class="ml-auto text-xs opacity-0 group-hover:opacity-100 transition-opacity text-cyan-400">
                        [F12]
                    </div>
                </a>
                <button @click="logout" type="button"
                    class="nav-item group flex items-center p-3 rounded-lg transition-all duration-300 font-mono text-sm cursor-pointer"
                    :class="isActive('/logout') ? 'bg-gradient-to-r from-green-600/20 to-cyan-600/20 border border-green-500/50 text-green-300' : 'text-gray-400 hover:text-green-300 hover:bg-gray-800/50 border border-transparent hover:border-green-500/30'">
                    <div class="cyber-icon-container">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span>logout.sys</span>
                    <div class="ml-auto text-xs opacity-0 group-hover:opacity-100 transition-opacity text-cyan-400">
                        [ALT+F4]
                    </div>
                </button>
            </nav>

            <div class="p-4 mt-auto">
                <div class="bg-gray-800/30 rounded-lg p-3 border border-gray-700/50">
                    <div class="text-xs font-mono text-gray-400 space-y-1">
                        <div class="flex justify-between">
                            <span>STATUS:</span>
                            <span class="text-green-400 blink">● ACTIVE</span>
                        </div>
                        <div class="flex justify-between">
                            <span>MEM:</span>
                            <span class="text-cyan-400">{{ stats.totalNotes }}KB</span>
                        </div>
                        <div class="flex justify-between">
                            <span>FILES:</span>
                            <span class="text-yellow-400">{{ stats.totalNotes }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 border-t border-gray-700/50">
                <div class="text-xs font-mono text-gray-500 bg-gray-900/50 p-2 rounded border border-gray-700/30">
                    <div class="text-green-400">$ whoami</div>
                    <div class="text-cyan-400">user@notes-system</div>
                    <div class="text-gray-400 mt-1">Ready for input...</div>
                </div>
            </div>
        </aside>
        <main class="h-full flex-1 cyber-bg">
            <slot />
        </main>
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { usePage, router } from '@inertiajs/vue3';

const page = usePage();

const isActive = (path: string) => {
    return page.url.startsWith(path);
};

const logout = () => {
    router.post('/logout')
}

const stats = computed(() => ({
    totalNotes: 42,
    memoryUsage: '1.2',
    status: 'ACTIVE'
}));
</script>

<style scoped>
.cyber-sidebar {
    background:
        linear-gradient(180deg, rgba(17, 24, 39, 0.95) 0%, rgba(31, 41, 55, 0.95) 100%);
    box-shadow:
        2px 0 10px rgba(0, 0, 0, 0.3),
        inset -1px 0 0 rgba(0, 255, 135, 0.1);
    position: relative;
}

.cyber-sidebar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background:
        linear-gradient(45deg, transparent 48%, rgba(0, 255, 135, 0.01) 49%, rgba(0, 255, 135, 0.01) 51%, transparent 52%);
    background-size: 30px 30px;
    pointer-events: none;
    opacity: 0.3;
}

.cyber-glow {
    text-shadow:
        0 0 5px currentColor,
        0 0 10px currentColor,
        0 0 15px currentColor;
}

.nav-item {
    position: relative;
    overflow: hidden;
}

.nav-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 255, 135, 0.1), transparent);
    transition: left 0.5s;
}

.nav-item:hover::before {
    left: 100%;
}

.cyber-icon-container {
    position: relative;
}

.nav-item:hover .cyber-icon-container::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    background: radial-gradient(circle, rgba(0, 255, 135, 0.2) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    animation: pulse 1.5s infinite;
}

@keyframes pulse {

    0%,
    100% {
        opacity: 0.5;
        transform: translate(-50%, -50%) scale(1);
    }

    50% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.2);
    }
}

@keyframes blink {

    0%,
    50% {
        opacity: 1;
    }

    51%,
    100% {
        opacity: 0.3;
    }
}

.blink {
    animation: blink 2s infinite;
}

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

.cyber-sidebar::-webkit-scrollbar {
    width: 6px;
}

.cyber-sidebar::-webkit-scrollbar-track {
    background: rgba(17, 24, 39, 0.5);
}

.cyber-sidebar::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #10b981, #06b6d4);
    border-radius: 3px;
}

.cyber-sidebar::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #059669, #0891b2);
}

@media (max-width: 768px) {
    .cyber-sidebar {
        width: 280px;
    }

    .nav-item span {
        font-size: 12px;
    }
}
</style>