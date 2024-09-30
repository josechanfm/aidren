<template>
  <form @submit.prevent="submitMessage" class="mt-4">
    <textarea v-model="content" class="w-full p-2 border rounded" rows="3" placeholder="Write your message..."></textarea>
    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Post Message</button>
  </form>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps(['topicId']);
const emit = defineEmits(['message-added']);

const content = ref('');

const form = useForm({
  content: '',
  topic_id: props.topicId,
});

function submitMessage() {
  form.post(route('forum.message.store'), {
    preserveScroll: true,
    onSuccess: () => {
      emit('message-added', form.data);
      content.value = '';
      form.reset();
    },
  });
}
</script>
