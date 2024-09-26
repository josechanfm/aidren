<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import PersonalInfo from './PersonalInfo.vue';
import Experiences from './Experiences.vue';

defineProps({
  portfolio: Object,
});
</script>

<template>
  <Head title="Portfolio" />

  <AppLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Portfolio
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="space-y-6">
          <PersonalInfo :personalInfo="portfolio.personalInfo" />
          <Experiences :experiences="portfolio.experiences" :portfolioId="portfolio.id" />
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.a-card {
  margin-bottom: 20px;
}
</style>
