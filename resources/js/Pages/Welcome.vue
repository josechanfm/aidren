<script setup>
import WebLayout from '@/Layouts/WebLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation } from 'swiper/modules';
import 'swiper/swiper-bundle.css';
import 'swiper/css';
import 'swiper/css/navigation';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

</script>

<template>
    <WebLayout title="Dashboard">


  <swiper :modules="[Navigation]" :navigation="true" :loop="true" class="mySwiper">
    <swiper-slide>
      <header class="relative bg-amber-800 text-white h-[500px] py-20 overflow-hidden">
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
          <source src="/images/AIDREN_Front.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
        <!-- Gray Overlay -->
        <div class="absolute inset-0 bg-gray-800 opacity-60 z-10"></div>
        <div class="max-w-7xl mx-auto text-center relative z-20">
          <h1 class="text-4xl font-bold">Empowering Resolution Through Innovation</h1>
          <p class="mt-4 text-lg">Join our community of experts dedicated to resolving disputes efficiently and effectively.</p>
          <a href="#services" class="mt-6 inline-block bg-white text-indigo-600 font-semibold py-2 px-6 rounded-lg shadow-lg hover:bg-gray-100">Explore Services</a>
        </div>
      </header>
    </swiper-slide>
    
    <swiper-slide>
      <header class="relative bg-gray-500 text-white h-[500px] py-20 overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/banner1.jpg');"></div>
        <div class="max-w-7xl mx-auto text-center relative z-20">
          <h1 class="text-4xl font-bold">Second Slide Title</h1>
          <p class="mt-4 text-lg">Description for the second slide.</p>
          <a href="#services" class="mt-6 inline-block bg-white text-indigo-600 font-semibold py-2 px-6 rounded-lg shadow-lg hover:bg-gray-100">Explore Services</a>
        </div>
      </header>
    </swiper-slide>

    <swiper-slide>
      <header class="relative bg-gray-500 text-white h-[500px] py-20 overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/banner2.jpg');"></div>
        <div class="max-w-7xl mx-auto text-center relative z-20">
          <h1 class="text-4xl font-bold">Third Slide Title</h1>
          <p class="mt-4 text-lg">Description for the third slide.</p>
          <a href="#services" class="mt-6 inline-block bg-white text-indigo-600 font-semibold py-2 px-6 rounded-lg shadow-lg hover:bg-gray-100">Explore Services</a>
        </div>
      </header>
    </swiper-slide>

    <!-- Add more slides as needed -->
  </swiper>


    <!-- About Section -->
    <section id="about" class="max-w-7xl mx-auto py-20 px-4">
        <h2 class="text-3xl font-bold text-center text-amber-800">About Us</h2>
        <p class="mt-4 text-gray-600 text-center">
            Our AI-powered Dispute Resolution Expert Network connects individuals and organizations with skilled professionals.
            We leverage cutting-edge technology to streamline the resolution process, making it faster, fairer, and more accessible for everyone.
        </p>
    </section>

    <!-- Intro Section -->
    <section id="intro" class="max-w-7xl mx-auto py-20 px-4">
        <a-row >
            <a-col :span="8" class="h-64"
                :style="{
                    backgroundImage: 'url(/images/image1.jpg)',
                    backgroundSize: 'cover', // Cover the entire column
                    backgroundPosition: 'center', // Center the image
                }"
            ></a-col>
            <a-col :span="16" class="h-64"
                :style="{
                    backgroundImage: 'url(/images/image2.jpg)',
                    backgroundSize: 'cover', // Cover the entire column
                    backgroundPosition: 'center', // Center the image
                }"
            ></a-col>
        </a-row>
        <a-row >
            <a-col :span="8" class="bg-red-100 h-64 p-10">
                <a-typography-title :level="3">Want to discuss working with GLG?</a-typography-title>
                <p>Find out how you can become a client and begin acting with confidence that comes from true clarity.</p>
                <a-button>CONTACT US</a-button>
            </a-col>
            <a-col :span="16" class="bg-white h-64 p-10">
                <a-typography-title :level="3">Interested in becoming a Network Member?</a-typography-title>
                <p>The world’s leading organizations trust our network of experts to help them move forward. GLG Network Members get to shape the direction of progress.</p>
                <a-button>GET START</a-button>
            </a-col>
        </a-row>
        <a-row >
            <a-col :span="8" class="bg-slate-500 text-white p-10 h-[400px]">
                <a-typography-title :level="3" :style="{ color: 'white' }">Interested in working for GLG?</a-typography-title>
                <p>GLG is hiring for critical roles. Check out our careers page and be a part of bringing the power of insight to every great professional decision.</p>
                <a-button>BROWSE OPEN POSITIONS</a-button>
            </a-col>
            <a-col :span="8" class="bg-green-100  h-[400px]"
                :style="{
                    backgroundImage: 'url(/images/image3.jpg)',
                    backgroundSize: 'cover', // Cover the entire column
                    backgroundPosition: 'center', // Center the image
                }"
            ></a-col>
            <a-col :span="8" class="bg-stash-400 h-[400px]">
                <a-col class=" h-[200px]"
                :style="{
                    backgroundImage: 'url(/images/image2.jpg)',
                    backgroundSize: 'cover', // Cover the entire column
                    backgroundPosition: 'center', // Center the image
                }"
                ></a-col>
                <a-col class="bg-gray-900 p-10 font text-white  h-[200px]">
                    <a-typography-title :level="3" :style="{ color: 'white' }">What does GLG do?</a-typography-title>
                    <p>GLG is The World’s Insight Network, bringing decision makers the insight it takes to get ahead.</p>
                    <a-button>BROWSE OPEN POSITIONS</a-button>
                </a-col>
            </a-col>
        </a-row>
    </section>


    <!-- Services Section -->
    <section id="services" class="bg-gray-200 py-20">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-amber-800">Our Core Services</h2>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-amber-600">Expert Consultation</h3>
                    <p class="mt-2 text-gray-600">Connect with seasoned professionals for tailored advice and strategies.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-amber-600">AI-Powered Mediation Tools</h3>
                    <p class="mt-2 text-gray-600">Utilize advanced tools to facilitate communication and negotiation.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-amber-600">Community Support Network</h3>
                    <p class="mt-2 text-gray-600">Join a vibrant community to share insights and resources.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-amber-600">Training & Development</h3>
                    <p class="mt-2 text-gray-600">Access workshops and courses to enhance your conflict resolution skills.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="max-w-7xl mx-auto py-20 px-4">
        <h2 class="text-3xl font-bold text-center text-amber-800">Get in Touch</h2>
        <p class="mt-4 text-gray-600 text-center">Have questions? We’d love to hear from you!</p>
        <div class="mt-6 text-center">
            <a href="mailto:info@disputeexpert.com" class="bg-amber-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-amber-500">Contact Us</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-amber-800 text-white py-4">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; 2024 AI Dispute Resolution Expert Network. All rights reserved.</p>
        </div>
    </footer>
    </WebLayout>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>

<style>
/* Add these styles for the navigation buttons */
.swiper-button-next,
.swiper-button-prev {
  color: white;
  background-color: rgba(0, 0, 0, 0.5);
  padding: 30px 20px;
  border-radius: 5px;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
  background-color: rgba(0, 0, 0, 0.7);
}
</style>
