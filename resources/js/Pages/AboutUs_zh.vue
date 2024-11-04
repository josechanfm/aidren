<script setup>
import WebLayout from '@/Layouts/WebLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="About Us" />
  <WebLayout>
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
      <h1 class="text-4xl font-bold mb-6 text-center">關於我們</h1>
      <p class="text-lg text-gray-700">
        AIDREN（AI Dispute Resolution Experts' Network）平台是香港首個專注於解決金融糾紛的人工智慧調解員及仲裁員平台，由香港科技大學及香港科學園共同資助。這一創新項目旨在利用先進的人工智慧技術，為金融糾紛提供高效、公正的解決方案。我們的平台結合了來自世界各地的國際人才，他們在各自的專業領域中貢獻所長，為平台的發展提供了強大的支持。目前，AIDREN平台已擁有來自中國及澳門的仲裁員，並且我們的調解員資歷獲得多個地區的認可，包括但不限於台灣、馬來西亞、香港、中國大陸、新加坡、英國及澳門。
      </p>
      <p class="text-lg text-gray-700">
        AIDREN平台的金融專業人才擁有多項國際認可的資歷，包括英國國際財務顧問、港澳保險相關資歷、港澳信貸及商賬管理、國際認可金融科技資歷、美國反洗錢師、英國國際合規資歷、香港財務策劃、美國項目管理師、風險及決策資歷，以及聯合國全球人工智慧網路的相關資歷。
      </p>
      <p class="text-lg text-gray-700">
        我們已經申請了2025年香港律政司「調解為先」星徽計劃及新加坡調解特許認證，這將進一步提升我們在國際調解及仲裁領域的影響力和認可度。AIDREN致力於成為金融糾紛解決的領導者，通過創新的技術和專業的服務，為客戶提供高效、可靠的解決方案。我們期待與更多的國際合作夥伴攜手，共同推動金融糾紛解決的未來發展。
      </p>
      <a-button class="mb-12" :href="route('aboutUs')">英文/English</a-button>

      <!-- Our Mission Section -->
      <div class="flex flex-col md:flex-row items-center mb-16">
        <div class="md:w-1/2 md:pr-8 mb-8 md:mb-0">
          <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1784&q=80" alt="Our Mission" class="rounded-lg shadow-lg w-full h-auto" />
        </div>
        <div class="md:w-1/2">
          <h2 class="text-3xl font-semibold mb-4">我們的使命</h2>
          <p class="text-lg text-gray-700">
            我們的使命是提供專業的調解服務，促進理解、便利溝通，並創造互利的解決方案。我們致力於將衝突轉化為成長和積極變化的機會，賦予個人和組織以建設性的方式向前邁進的能力。
          </p>
        </div>
      </div>

      <!-- Our Vision Section -->
      <div class="flex flex-col md:flex-row-reverse items-center">
        <div class="md:w-1/2 md:pl-8 mb-8 md:mb-0">
          <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1742&q=80" alt="Our Vision" class="rounded-lg shadow-lg w-full h-auto" />
        </div>
        <div class="md:w-1/2">
          <h2 class="text-3xl font-semibold mb-4">我們的願景</h2>
          <p class="text-lg text-gray-700">
            我們展望一個將衝突視為對話和積極轉型機會的世界。我們的目標是站在創新調解實踐的最前沿，為各個領域和文化的衝突解決樹立卓越的標準。我們希望透過賦予個人和組織以共同合作和建設性解決糾紛的工具和心態，來創造一個更和諧的社會。
          </p>
        </div>
      </div>
    </div>
  </WebLayout>
</template>
