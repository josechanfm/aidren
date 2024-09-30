<template>
  <WebLayout>
    <div class="container mx-auto mt-8">
      <h1 class="text-2xl font-bold mb-4">Private Messages</h1>
      <div v-for="message in messages" :key="message.id" class="mb-4 p-4 border rounded">
        <p>{{ message.content }}</p>
        <p class="text-sm text-gray-500 mt-2">
          From: {{ message.sender.name }} | To: {{ message.recipient.name }}
        </p>
      </div>
      <NewPrivateMessageForm @message-sent="addMessage" />
    </div>
  </WebLayout>
</template>

<script setup>
import WebLayout from '@/Layouts/WebLayout.vue';
import NewPrivateMessageForm from '@/Components/Messages/NewPrivateMessageForm.vue';
import { ref } from 'vue';

const props = defineProps({
  messages: Array,
});

const localMessages = ref(props.messages);

function addMessage(message) {
  localMessages.value.unshift(message);
}
</script>
