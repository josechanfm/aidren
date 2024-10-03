<template>
  <AppLayout>
    <Head :title="topic.title" />
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <h1 class="text-3xl font-bold mb-6">{{ topic.title }}</h1>
          <div class="space-y-6">
            <MessageItem
              v-for="message in messages"
              :key="message.id"
              :message="message"
              :canEdit="canEdit"
              :canDelete="canDelete"
              :topicId="topic.id"
              @reply-added="addReply"
            />
          </div>
          <NewMessageForm 
            :topicId="topic.id" 
            @message-sent="addMessage"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import MessageItem from './MessageItem.vue';
import NewMessageForm from './NewMessageForm.vue';

const props = defineProps({
  topic: Object,
  messages: Array,
  canEdit: Boolean,
  canDelete: Boolean,
});

const messages = ref(props.messages);

function addMessage(newMessage) {
  messages.value.push(newMessage);
}

function addReply(newReply, parentId) {
  const parentMessage = messages.value.find(m => m.id === parentId);
  if (parentMessage) {
    if (!parentMessage.replies) {
      parentMessage.replies = [];
    }
    parentMessage.replies.push(newReply);
  }
}
</script>
