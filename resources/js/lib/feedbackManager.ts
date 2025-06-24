import { ref, h, render } from 'vue';
import FeedbackToast from '@/components/FeedbackToast.vue';

export function useFeedbackManager() {
  const feedbacks = ref([]);

  const addFeedback = (message:string, type = 'info', duration = 3000) => {
    const id = Date.now();
    const container = document.createElement('div');
    
    const vnode = h(FeedbackToast, {
      message,
      type,
      duration,
      onRemove: () => removeFeedback(id)
    });
    
    render(vnode, container);
    document.body.appendChild(container);

    feedbacks.value.push({ id, container });
  };

  const removeFeedback = (id:number) => {
    const index = feedbacks.value.findIndex(f => f.id === id);
    if (index !== -1) {
      const { container } = feedbacks.value[index];
      render(null, container);
      document.body.removeChild(container);
      feedbacks.value.splice(index, 1);
    }
  };

  return {
    addFeedback
  };
}