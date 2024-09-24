<script setup>
import WebLayout from '@/Layouts/WebLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="About Us" />
  <WebLayout>
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
      <h1 class="text-4xl font-bold mb-6 text-center">About Us</h1>
      <p class="text-lg text-gray-700 mb-12 text-center">
        We are a dedicated team of professional mediators committed to resolving conflicts 
        and fostering understanding between parties. Our expertise spans various fields, 
        allowing us to provide tailored mediation services for diverse situations.
      </p>

      <!-- Our Mission Section -->
      <div class="flex flex-col md:flex-row items-center mb-16">
        <div class="md:w-1/2 md:pr-8 mb-8 md:mb-0">
          <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1784&q=80" alt="Our Mission" class="rounded-lg shadow-lg w-full h-auto" />
        </div>
        <div class="md:w-1/2">
          <h2 class="text-3xl font-semibold mb-4">Our Mission</h2>
          <p class="text-lg text-gray-700">
            Our mission is to provide expert mediation services that foster understanding, 
            facilitate communication, and create mutually beneficial resolutions. We strive 
            to transform conflicts into opportunities for growth and positive change, 
            empowering individuals and organizations to move forward constructively.
          </p>
        </div>
      </div>

      <!-- Our Vision Section -->
      <div class="flex flex-col md:flex-row-reverse items-center">
        <div class="md:w-1/2 md:pl-8 mb-8 md:mb-0">
          <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1742&q=80" alt="Our Vision" class="rounded-lg shadow-lg w-full h-auto" />
        </div>
        <div class="md:w-1/2">
          <h2 class="text-3xl font-semibold mb-4">Our Vision</h2>
          <p class="text-lg text-gray-700">
            We envision a world where conflict is viewed as an opportunity for dialogue and 
            positive transformation. Our aim is to be at the forefront of innovative mediation 
            practices, setting the standard for excellence in conflict resolution across diverse 
            fields and cultures. We aspire to create a more harmonious society by empowering 
            individuals and organizations with the tools and mindset to resolve disputes 
            collaboratively and constructively.
          </p>
        </div>
      </div>
    </div>
  </WebLayout>
</template>
