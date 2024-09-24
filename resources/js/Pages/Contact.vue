<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import WebLayout from '@/Layouts/WebLayout.vue';

const form = useForm({
  name: '',
  email: '',
  subject: '',
  message: '',
});

const offices = [
  {
    country: 'United States',
    address: '123 Resolution Ave, New York, NY 10001',
    phone: '+1 (212) 555-1234',
    email: 'us@aidren.org',
  },
  {
    country: 'United Kingdom',
    address: '45 Mediation Lane, London, EC1A 1BB',
    phone: '+44 20 7123 4567',
    email: 'uk@aidren.org',
  },
  {
    country: 'Germany',
    address: 'Schlichtungsstraße 67, 10115 Berlin',
    phone: '+49 30 987654321',
    email: 'de@aidren.org',
  },
  {
    country: 'Japan',
    address: '2-1-1 Arbitration, Chiyoda-ku, Tokyo 100-0001',
    phone: '+81 3 1234 5678',
    email: 'jp@aidren.org',
  },
];

const submitForm = () => {
  form.post('/contact', {
    preserveScroll: true,
    onSuccess: () => {
      alert('Your message has been sent successfully!');
      form.reset();
    },
  });
};
</script>

<template>
  <WebLayout>
    <Head title="Contact Us" />

    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
      <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Contact Us</h1>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
        <!-- Liaison Offices -->
        <div>
          <h2 class="text-2xl font-semibold mb-6">Our Liaison Offices</h2>
          <div class="space-y-8">
            <div v-for="office in offices" :key="office.country" class="bg-white p-6 rounded-lg shadow-md">
              <h3 class="text-xl font-semibold mb-2">{{ office.country }}</h3>
              <p class="text-gray-600 mb-1">{{ office.address }}</p>
              <p class="text-gray-600 mb-1">Phone: {{ office.phone }}</p>
              <p class="text-gray-600">Email: {{ office.email }}</p>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <div>
          <h2 class="text-2xl font-semibold mb-6">Send Us a Message</h2>
          <form @submit.prevent="submitForm" class="space-y-4">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
              <input v-model="form.name" type="text" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input v-model="form.email" type="email" id="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
              <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
              <input v-model="form.subject" type="text" id="subject" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
              <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
              <textarea v-model="form.message" id="message" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            </div>
            <div>
              <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
                Send Message
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </WebLayout>
</template>
