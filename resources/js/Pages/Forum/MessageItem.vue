<template>
  <div class="bg-white shadow-sm rounded-lg p-4 mb-4">
    <div class="flex justify-between items-start">
      <div>
        <h3 class="font-semibold text-lg">{{ message.user.name }}</h3>
        <p class="text-gray-500 text-sm">{{ message.created_at }}</p>
      </div>
      <div v-if="canEdit || canDelete" class="space-x-2">
        <button v-if="canEdit" @click="startEditing" class="text-blue-600 hover:text-blue-800">Edit</button>
        <button v-if="canDelete" @click="deleteMessage" class="text-red-600 hover:text-red-800">Delete</button>
      </div>
    </div>

    <div v-if="!isEditing" class="mt-2">
      <p>{{ message.content }}</p>
    </div>
    <form v-else @submit.prevent="submitEdit" class="mt-2">
      <textarea
        v-model="editForm.content"
        class="w-full p-2 border rounded"
        rows="3"
      ></textarea>
      <div class="mt-2 space-x-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
        <button @click="cancelEditing" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
      </div>
    </form>

    <div class="mt-4">
      <button @click="toggleReplyForm" class="text-blue-600 hover:text-blue-800">Reply</button>
    </div>

    <form v-if="showReplyForm" @submit.prevent="submitReply" class="mt-2">
      <textarea
        v-model="replyForm.content"
        class="w-full p-2 border rounded"
        rows="3"
        placeholder="Write your reply..."
      ></textarea>
      <div class="mt-2 flex items-center">
        <label class="inline-flex items-center">
          <input type="checkbox" v-model="replyForm.isPrivate" class="form-checkbox h-5 w-5 text-blue-600">
          <span class="ml-2 text-gray-700">Private reply (only visible to message owner)</span>
        </label>
      </div>
      <div class="mt-2 flex justify-end">
        <button 
          type="submit" 
          class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
        >
          {{ replyForm.isPrivate ? 'Send Private Reply' : 'Post Reply' }}
        </button>
      </div>
    </form>

    <div v-if="message.replies && message.replies.length > 0" class="mt-4 space-y-4">
      <div v-for="reply in message.replies" :key="reply.id" class="ml-8 bg-gray-50 p-3 rounded">
        <div class="flex justify-between items-start">
          <div>
            <h4 class="font-semibold">{{ reply.user.name }}</h4>
            <p class="text-gray-500 text-sm">{{ reply.created_at }}</p>
          </div>
          <div v-if="reply.isPrivate" class="text-sm text-gray-500">Private</div>
        </div>
        <p class="mt-2">{{ reply.content }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  message: Object,
  canEdit: Boolean,
  canDelete: Boolean,
});

const isEditing = ref(false);
const showReplyForm = ref(false);

const editForm = useForm({
  content: props.message.content,
});

const replyForm = useForm({
  content: '',
  isPrivate: false,
});

const startEditing = () => {
  isEditing.value = true;
};

const cancelEditing = () => {
  isEditing.value = false;
  editForm.reset();
};

const submitEdit = () => {
  editForm.put(route('forum.messages.update', props.message.id), {
    preserveScroll: true,
    onSuccess: () => {
      isEditing.value = false;
    },
  });
};

const deleteMessage = () => {
  if (confirm('Are you sure you want to delete this message?')) {
    useForm().delete(route('forum.messages.destroy', props.message.id));
  }
};

const toggleReplyForm = () => {
  showReplyForm.value = !showReplyForm.value;
};

const submitReply = () => {
  replyForm.post(route('forum.messages.reply', props.message.id), {
    preserveScroll: true,
    onSuccess: () => {
      showReplyForm.value = false;
      replyForm.reset();
    },
  });
};
</script>
