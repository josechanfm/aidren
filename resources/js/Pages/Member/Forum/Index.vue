<template>
  <AppLayout>
    <Head title="Forum" />

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <h1 class="text-2xl font-bold mb-4">Forum Topics</h1>
          <div v-role="'admin'">
            <a-button type="primary" @click="toggleNewTopicForm" class="mb-4">
              {{ showNewTopicForm ? 'Hide Form' : 'New Topic' }}
            </a-button>
            <a-card v-if="showNewTopicForm" title="Create New Topic" class="mb-4">
              <a-form 
                :model="newTopic"
                :rules="rules"
                @finish="onFinish"
                layout="vertical"
              >
                <a-form-item label="Title" name="title">
                  <a-input type="input" v-model:value="newTopic.title" />
                </a-form-item>
                <a-form-item label="Description" name="description">
                  <a-textarea v-model:value="newTopic.description" :rows="4" />
                </a-form-item>
                <a-form-item label="Category" name="category_code">
                  <a-select v-model:value="newTopic.category_code" :options="categories" />
                </a-form-item>
                <a-form-item>
                  <a-button type="primary" html-type="submit">Create Topic</a-button>
                </a-form-item>
              </a-form>
            </a-card>
          </div>
          <div class="space-y-4">
            <div v-for="topic in topics" :key="topic.id" class="border p-4 rounded">
              <h2 class="text-xl font-semibold">
                <inertia-link :href="route('member.forum.topics.show', topic.id)" class="text-blue-600 hover:text-blue-800">
                  {{ topic.title }}
                </inertia-link>
              </h2>
              <p class="text-gray-600 mt-2">{{ topic.description }}</p>
              <div class="mt-2 text-sm text-gray-500">
                Posted by {{ topic.user.name }} | {{ formatDate(topic.created_at) }} | {{ topic.replies_count }} replies
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import dayjs from 'dayjs';

export default {
  components: {
    AppLayout,
    Head,
  },
  props: {
    topics: Array,
    categories: Array,
  },
  data() {
    return {
      newTopic: {
        title: '',
        description: '',
        category_code: undefined,
      },
      showNewTopicForm: false,
      rules: {
        title: [{ required: true, message: 'Title is required!' }],
        description: [{ required: true, message: 'Description is required!' }],
        category_code: [{ required: true, message: 'Category is required!' }],
      },
    };
  },
  methods: {
    toggleNewTopicForm() {
      this.showNewTopicForm = !this.showNewTopicForm;
    },
    onFinish() {
      this.$inertia.post(route("member.forum.topics.store"), this.newTopic, {
        preserveState: false,
        preserveScroll: true,
        onSuccess: () => {
          this.showNewTopicForm = false;
          this.newTopic = {
            title: '',
            description: '',
            category_code: undefined,
          };
        },
        onError: (errors) => {
          console.error('Form submission errors:', errors);
        },
      });
    },
    formatDate(date) {
      return dayjs(date).format('YYYY-MM-DD HH:mm');
    },
  },
};
</script>
