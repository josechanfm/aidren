<template>
  <form @submit.prevent="submitTopic" class="mt-8 border-t pt-4">
    <h2 class="text-xl font-semibold mb-4">Create New Topic</h2>
    <div class="mb-4">
      <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
      <input v-model="form.title" type="text" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    </div>
    <div class="mb-4">
      <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
      <textarea v-model="form.description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
    </div>
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create Topic</button>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const emit = defineEmits(['topic-added']);

const form = useForm({
  title: '',
  description: '',
});

function submitTopic() {
  form.post(route('forum.topic.store'), {
    preserveScroll: true,
    onSuccess: () => {
      emit('topic-added', form.data);
      form.reset();
    },
  });
}
</script>
