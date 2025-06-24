<template>
    <div class="min-h-screen bg-gray-900 cyber-bg flex items-center justify-center p-4">
        <Head title="SYSTEM_LOGIN.exe" />
        
        <div class="w-full max-w-md">
            <div class="terminal-window bg-gray-800/60 border border-green-500/30 rounded-lg backdrop-blur-sm overflow-hidden">
                <!-- Terminal header -->
                <div class="terminal-header bg-gray-900/80 p-3 border-b border-green-500/30">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="ml-2 text-xs text-gray-400 font-mono">~/auth/login.sh</span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="text-center mb-8">
                        <h1 class="text-2xl font-bold text-green-400 cyber-glow font-mono mb-2">
                            &gt; SYSTEM_ACCESS.exe
                        </h1>
                        <div class="text-sm text-cyan-400 font-mono">
                            [AUTHENTICATION_REQUIRED]
                        </div>
                        <div class="text-xs text-gray-500 font-mono mt-1">
                            Enter credentials to access the system
                        </div>
                    </div>

                    <div v-if="status" class="mb-4 text-center">
                        <div class="text-sm text-green-400 font-mono bg-gray-900/40 p-2 rounded border border-green-500/30">
                            <span class="text-cyan-400">$ echo "</span>{{ status }}<span class="text-cyan-400">"</span>
                        </div>
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-mono text-cyan-400">
                                $ user@system:~$ whoami
                            </label>
                            <div class="relative">
                                <input
                                    id="email"
                                    type="email"
                                    required
                                    autofocus
                                    :tabindex="1"
                                    autocomplete="email"
                                    v-model="form.email"
                                    placeholder="user@domain.com"
                                    class="w-full px-4 py-3 bg-gray-800/80 border border-cyan-500/50 rounded text-green-300 placeholder-gray-500 focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 focus:bg-gray-800 transition-all font-mono text-sm"
                                />
                                <div class="absolute right-3 top-3 text-cyan-400 opacity-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                            </div>
                            <div v-if="form.errors.email" class="text-red-400 text-xs font-mono bg-gray-900/40 p-2 rounded border border-red-500/30">
                                <span class="text-red-500">ERROR:</span> {{ form.errors.email }}
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm font-mono text-cyan-400">
                                    $ sudo authenticate
                                </label>
                                <a v-if="canResetPassword" 
                                   :href="route('password.request')" 
                                   class="text-xs text-gray-400 hover:text-cyan-400 font-mono transition-colors border-b border-gray-600 hover:border-cyan-400"
                                   :tabindex="5">
                                    recovery.sh
                                </a>
                            </div>
                            <div class="relative">
                                <input
                                    id="password"
                                    type="password"
                                    required
                                    :tabindex="2"
                                    autocomplete="current-password"
                                    v-model="form.password"
                                    placeholder="••••••••••••"
                                    class="w-full px-4 py-3 bg-gray-800/80 border border-cyan-500/50 rounded text-green-300 placeholder-gray-500 focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 focus:bg-gray-800 transition-all font-mono text-sm"
                                />
                                <div class="absolute right-3 top-3 text-cyan-400 opacity-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                            </div>
                            <div v-if="form.errors.password" class="text-red-400 text-xs font-mono bg-gray-900/40 p-2 rounded border border-red-500/30">
                                <span class="text-red-500">ERROR:</span> {{ form.errors.password }}
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <input
                                id="remember"
                                type="checkbox"
                                v-model="form.remember"
                                :tabindex="3"
                                class="w-4 h-4 text-cyan-400 bg-gray-800 border-gray-600 rounded focus:ring-cyan-400 focus:ring-2"
                            />
                            <label for="remember" class="text-sm text-gray-300 font-mono">
                                --save-session
                            </label>
                        </div>

                        <button
                            type="submit"
                            :tabindex="4"
                            :disabled="form.processing"
                            class="w-full py-3 px-4 bg-gradient-to-r from-green-600 to-cyan-600 text-black font-bold rounded border border-green-400 hover:from-green-500 hover:to-cyan-500 transition-all cyber-button font-mono text-sm shadow-lg shadow-green-500/25 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <div class="flex items-center justify-center space-x-2">
                                <svg v-if="form.processing" class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.001 8.001 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ form.processing ? 'AUTHENTICATING...' : 'GRANT_ACCESS' }}</span>
                            </div>
                        </button>
                    </form>
                </div>
            </div>

            <div v-if="form.processing" class="mt-4 text-center">
                <div class="inline-flex items-center space-x-2 text-cyan-400 font-mono text-sm">
                    <div class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></div>
                    <div class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
                    <div class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
                    <span class="ml-2">Connecting to server...</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<style scoped>
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

.cyber-glow {
    text-shadow: 
        0 0 5px currentColor,
        0 0 10px currentColor,
        0 0 15px currentColor;
}

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

.cyber-button:disabled::before {
    display: none;
}

.terminal-window {
    box-shadow: 
        0 10px 30px rgba(0, 0, 0, 0.5),
        inset 0 1px 0 rgba(0, 255, 135, 0.1);
}

input:focus {
    box-shadow: 
        0 0 0 2px rgba(6, 182, 212, 0.3),
        0 0 10px rgba(6, 182, 212, 0.2);
}

input[type="checkbox"]:checked {
    background-color: #06b6d4;
    border-color: #06b6d4;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.3; }
}

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
</style>