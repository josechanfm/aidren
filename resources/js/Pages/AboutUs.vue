<script>
import WebLayout from '@/Layouts/WebLayout.vue';
import { Head } from '@inertiajs/vue3';

export default {
  components: {
    WebLayout,
    Head,
  },
};
</script>

<template>
  <Head title="About Us" />
  <WebLayout>
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
          About AI Dispute Resolution Expert Network
        </h2>
        <p class="mt-4 text-lg text-gray-500">
          We are dedicated to revolutionizing dispute resolution through innovative AI technologies.
        </p>
      </div>
      <div class="mt-20">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
          <div>
            <h3 class="text-2xl font-bold text-gray-900">Our Mission</h3>
            <p class="mt-4 text-lg text-gray-500">
              To provide efficient, fair, and accessible dispute resolution services by leveraging cutting-edge AI technologies and human expertise.
            </p>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-gray-900">Our Vision</h3>
            <p class="mt-4 text-lg text-gray-500">
              To create a world where disputes are resolved quickly, fairly, and with minimal friction, fostering harmony and progress in communities and businesses alike.
            </p>
          </div>
        </div>
      </div>
    </div>
  </WebLayout>
</template>
