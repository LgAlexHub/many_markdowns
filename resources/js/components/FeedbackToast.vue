<template>
    <Transition
        enter-active-class="transition ease-out duration-300" enter-from-class="transform opacity-0 scale-95"
        enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-200"
        leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
        <div 
            v-if="isVisible" :class="[
                'fixed top-4 right-4 px-4 py-2 rounded-md shadow-lg z-50 font-semibold',
                typeClasses[type]
            ]">
            {{ message }}
        </div>
    </Transition>   
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';

const emits = defineEmits(['remove']); 

const props = defineProps({
    message: {
        type: String,
        required: true
    },
    type: {
        type: String,
        default: 'info',
        validator: (value) => ['success', 'error', 'info', 'warning'].includes(value as string)
    },
    duration: {
        type: Number,
        default: 3000
    }
});

const isVisible = ref(true);

const typeClasses = {
  success: 'bg-green-500 text-white',
  error: 'bg-red-500 text-white',
  info: 'bg-blue-500 text-white',
  warning: 'bg-yellow-500 text-white'
} as { [key:string] : string };

onMounted(() => {
  setTimeout(() => {
    isVisible.value = false;
    setTimeout(() => emits('remove'), 200);
  }, props.duration);
});

</script>