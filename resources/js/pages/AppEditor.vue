<script setup lang="ts">
import type { Ref } from 'vue';
import { ref, computed, onMounted, watch } from 'vue';
import Editor from '@/components/Editor.vue';
import MyAppLayout from '@/layouts/MyAppLayout.vue';
import { useFeedbackManager } from '@/lib/feedbackManager';

const props = defineProps(['note']);

onMounted(() => {
    noteId.value = props.note?.id;
    noteTitle.value = props.note?.title;
    markdownContent.value = props.note?.content;
});

const feedbackManager = useFeedbackManager();
const debounce = (func: (...args: any) => void, timeout = 2000) => {
    let timer: number;
    return (...args: []) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}

const markdownContent = ref('');
const noteId: Ref<number | undefined> = ref();
const noteTitle: Ref<string | undefined> = ref();
const noteFormData = computed(() => {
    return JSON.stringify({
        id : noteId.value,
        title : noteTitle.value,
        content : markdownContent.value
    })
});

const updateTitle = (payload: string) => noteTitle.value = payload;

const saveOrCreateNote = debounce((payload) => {
    markdownContent.value = payload;
    const method = noteId.value ? 'PUT' : 'POST';
    if (noteTitle.value)
        fetch('/api/save', {
            method: method,
            body: noteFormData.value,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        }).then(async res => {
            const json = await res.json()
            feedbackManager.addFeedback(json, 'success', 5 * 1000);
        }).catch(err => {
            feedbackManager.addFeedback(err, 'error', 5 * 1000);
        });
})

watch(() => props.note, (newNote) => {
    if (newNote) {
        noteId.value = newNote.id;
        noteTitle.value = newNote.title;
        markdownContent.value = newNote.content;
    }
}, { immediate: true });

</script>

<template>
    <MyAppLayout>
        <Editor :model-value="markdownContent" :title="noteTitle" @title-updated="updateTitle"
            @update:model-value="saveOrCreateNote"></Editor>
    </MyAppLayout>
</template>