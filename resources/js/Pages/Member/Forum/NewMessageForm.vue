<template>
  <div class="mt-6 bg-white shadow-sm rounded-lg p-4">
    <h3 class="text-lg font-semibold mb-4">Add a New Message</h3>
    <form @submit.prevent="submitMessage">
      <div class="mb-4">
        <label for="content" class="block text-sm font-medium text-gray-700">Message</label>
        <textarea
          id="content"
          v-model="content"
          rows="4"
          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
          placeholder="Write your message here..."
          required
        ></textarea>
      </div>
      <div class="flex items-center justify-end">
        <button
          type="submit"
          class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
          :disabled="submitting"
        >
          Post Message
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    topicId: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      content: '',
      submitting: false
    }
  },
  methods: {
    submitMessage() {
      this.submitting = true;
      axios.post(route('member.topic.messages.store', { topic: this.topicId }), {
        content: this.content
      })
      .then(response => {
        console.log(response.data);
        // Assuming the server returns the new message in the response
        this.$emit('messageSent', response.data);
        this.content = '';
      })
      .catch(error => {
        console.error('Error posting message:', error);
        // Handle error (e.g., show error message to user)
      })
      .finally(() => {
        this.submitting = false;
      });
    }
  }
}
</script>
