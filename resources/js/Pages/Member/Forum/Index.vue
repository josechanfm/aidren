<template>
  <AppLayout>
    <Head title="Forum" />

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <h1 class="text-2xl font-bold mb-4">Forum Topics</h1>
          <button @click="toggleNewTopicForm" class="mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            New Topic
          </button>
          <div v-if="showNewTopicForm" class="mb-6 p-4 bg-gray-100 rounded">
            <form @submit.prevent="submitNewTopic">
              <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input v-model="form.title" type="text" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
              </div>
              <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea v-model="form.content" id="content" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
              </div>
              <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select v-model="form.category_id" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                  <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name }}
                  </option>
                </select>
              </div>
              <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Create Topic
              </button>
            </form>
          </div>
          <div class="space-y-4">
            <div v-for="topic in topics" :key="topic.id" class="border p-4 rounded">
              <h2 class="text-xl font-semibold">
                <inertia-link :href="route('member.forum.topics.show', topic.id)" class="text-blue-600 hover:text-blue-800">
                  {{ topic.title }}
                </inertia-link>
              </h2>
              <p class="text-gray-600">{{ topic.excerpt }}</p>
              <div class="mt-2 text-sm text-gray-500">
                Posted by {{ topic.user.name }} | {{ topic.created_at }} | {{ topic.replies_count }} replies
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  topics: Array,
  categories: Array,
});

const form = useForm({
  title: '',
  content: '',
  category_id: '',
});

const showNewTopicForm = ref(false);

const toggleNewTopicForm = () => {
  showNewTopicForm.value = !showNewTopicForm.value;
};

const submitNewTopic = () => {
  form.post(route('member.topics.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      showNewTopicForm.value = false;
    },
  });
};
</script>
