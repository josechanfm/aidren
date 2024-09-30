<template>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">AI Dispute Resolution Assistant</h1>
        <div class="mb-4">
            <label for="engine" class="block text-sm font-medium text-gray-700">Select AI Engine:</label>
            <select v-model="selectedEngine" id="engine" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                <option v-for="engine in engines" :key="engine.value" :value="engine.value">
                    {{ engine.name }}
                </option>
            </select>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg mb-4 h-96 overflow-y-auto" ref="chatContainer">
            <div v-for="(message, index) in messages" :key="index" class="mb-4">
                <div class="flex justify-start">
                    <div :class="{
                        'bg-blue-500 text-white p-3 rounded-lg max-w-3/4': message.sender === 'You',
                        'bg-gray-300 text-black p-3 rounded-lg max-w-3/4': message.sender === 'Bot'
                    }">
                        <span class="font-bold mr-2">{{ message.sender }}:</span>
                        <span v-html="message.text"></span>
                    </div>
                </div>
            </div>
        </div>
        <form @submit.prevent="sendMessage" class="flex">
            <input
                v-model="userMessage"
                type="text"
                placeholder="Type your message..."
                class="flex-grow border rounded-l px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                ref="messageInput"
            >
            <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                Send
            </button>
        </form>
    </div>
</template>

<script>
import { ref, onUpdated, nextTick } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const messages = ref([]);
        const userMessage = ref('');
        const messageInput = ref(null);
        const chatContainer = ref(null);
        const selectedEngine = ref('gpt2');
        const engines = ref([
            { name: 'GPT-2', value: 'gpt2' },
            { name: 'DialoGPT (Small)', value: 'microsoft/DialoGPT-small' },
            { name: 'DialoGPT (Medium)', value: 'microsoft/DialoGPT-medium' },
            { name: 'DialoGPT (Large)', value: 'microsoft/DialoGPT-large' },
            { name: 'T5 (Small)', value: 't5-small' },
            { name: 'BART (Large)', value: 'facebook/bart-large' },
            { name: 'GPT-Neo (125M)', value: 'EleutherAI/gpt-neo-125M' },
            { name: 'GPT-J (6B)', value: 'EleutherAI/gpt-j-6B' },
        ]);

        const scrollToBottom = () => {
            nextTick(() => {
                if (chatContainer.value) {
                    chatContainer.value.scrollTop = chatContainer.value.scrollHeight;
                }
            });
        };

        onUpdated(scrollToBottom);

        const sendMessage = async () => {
            if (userMessage.value.trim() === '') return;

            messages.value.push({ sender: 'You', text: userMessage.value });
            scrollToBottom();

            try {
                console.log('Sending request to /chat');
                const response = await axios.post('/chat', { 
                    message: userMessage.value,
                    engine: selectedEngine.value
                });
                console.log('Response received:', response.data);
                messages.value.push({ sender: 'Bot', text: response.data.reply });
                scrollToBottom();
            } catch (error) {
                console.error('Error details:', error.response ? error.response.data : error.message);
                let errorMessage = 'Sorry, an error occurred.';
                if (error.response && error.response.data && error.response.data.reply) {
                    errorMessage = error.response.data.reply;
                }
                messages.value.push({ sender: 'Bot', text: errorMessage });
                scrollToBottom();
            }

            userMessage.value = '';
            if (messageInput.value) {
                messageInput.value.focus();
            }
        };

        return {
            messages,
            userMessage,
            sendMessage,
            messageInput,
            chatContainer,
            selectedEngine,
            engines
        };
    },
};
</script>