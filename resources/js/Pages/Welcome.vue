<script setup>
import { ref, onMounted } from 'vue';
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

const slides = ref([
  {
    type: 'video',
    src: 'https://player.vimeo.com/external/496296003.sd.mp4?s=1b8f0f3d7c4b7e0d6b9c8f7e3e3f3e3f3e3f3e3f&profile_id=165&oauth2_token_id=57447761',
    title: 'Empowering Resolution Through Innovation',
    description: 'Join our community of experts dedicated to resolving disputes efficiently and effectively.',
    buttonText: 'Explore Services',
    buttonLink: '/services'
  },
  {
    type: 'image',
    src: 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
    title: 'Expert Mediation Services',
    description: 'Our skilled mediators help resolve conflicts with professionalism and care.',
    buttonText: 'Meet Our Experts',
    buttonLink: '/mediators'
  },
  {
    type: 'image',
    src: 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2068&q=80',
    title: 'Collaborative Problem Solving',
    description: 'We facilitate open dialogue to find mutually beneficial solutions.',
    buttonText: 'Our Approach',
    buttonLink: '/abo'
  }
]);

onMounted(() => {
  const video = document.querySelector('video');
  if (video) {
    video.addEventListener('error', (e) => {
      console.error('Video error:', e);
    });
    
    video.addEventListener('loadeddata', () => {
      console.log('Video loaded successfully');
    });
  }
});
</script>

<template>
    <WebLayout title="Dashboard">
        <swiper :modules="[Navigation]" :navigation="true" :loop="true" class="mySwiper">
            <swiper-slide v-for="(slide, index) in slides" :key="index">
                <header class="relative bg-amber-800 text-white h-[500px] py-20 overflow-hidden">
                    <video 
                      v-if="slide.type === 'video'" 
                      autoplay 
                      loop 
                      muted 
                      playsinline 
                      class="absolute inset-0 w-full h-full object-cover z-0"
                      @error="(e) => console.error('Video error:', e)"
                      poster="https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg"
                    >
                        <source :src="slide.src" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div v-else class="absolute inset-0 bg-cover bg-center" :style="{ backgroundImage: `url(${slide.src})` }"></div>
                    <!-- Gray Overlay -->
                    <div class="absolute inset-0 bg-gray-800 opacity-60 z-10"></div>
                    <div class="max-w-7xl mx-auto text-center relative z-20">
                        <h1 class="text-4xl font-bold">{{ slide.title }}</h1>
                        <p class="mt-4 text-lg">{{ slide.description }}</p>
                        <a :href="slide.buttonLink" class="mt-6 inline-block bg-white text-indigo-600 font-semibold py-2 px-6 rounded-lg shadow-lg hover:bg-gray-100">
                            {{ slide.buttonText }}
                        </a>
                    </div>
                </header>
            </swiper-slide>
        </swiper>

        <!-- About Section -->
        <section id="about" class="max-w-7xl mx-auto py-20 px-4">
            <h2 class="text-3xl font-bold text-center text-amber-800">About Us</h2>
            <p class="mt-4 text-gray-600 text-center text-xl">
                Our AI-powered Dispute Resolution Expert Network connects individuals and organizations with skilled professionals.
                We leverage cutting-edge technology to streamline the resolution process, making it faster, fairer, and more accessible for everyone.
            </p>
            <p class="mt-4 text-gray-600 text-center text-xl">
                Endorsed by the Department of Justice of Hong Kong and supported by HK EBRAM.
            </p>
        </section>

        <!-- Intro Section -->
        <section id="intro" class="max-w-7xl mx-auto py-20 px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="h-64 bg-cover bg-center" :style="{ backgroundImage: 'url(/images/image1.jpg)' }"></div>
                <div class="h-64 bg-cover bg-center" :style="{ backgroundImage: 'url(/images/image2.jpg)' }"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="bg-red-100 min-h-[300px] p-10">
                    <h3 class="text-2xl font-semibold mb-4">Want to discuss working with AIDREN?</h3>
                    <p>Find out how you can become a client and begin acting with confidence that comes from true clarity.</p>
                    <a href="#" class="mt-4 inline-block bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:bg-indigo-700">CONTACT US</a>
                </div>
                <div class="bg-white min-h-[300px] p-10">
                    <h3 class="text-2xl font-semibold mb-4">Interested in becoming a Network Member?</h3>
                    <p>The world's leading organizations trust our network of experts to help them move forward. AIDREN Network Members get to shape the direction of progress.</p>
                    <a href="#" class="mt-4 inline-block bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:bg-indigo-700">GET START</a>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div class="bg-slate-500 text-white p-10 min-h-[300px]">
                    <h3 class="text-2xl font-semibold mb-4">Interested in working for AIDREN?</h3>
                    <p>AIDREN is hiring for critical roles. Check out our careers page and be a part of bringing the power of insight to every great professional decision.</p>
                    <a href="#" class="mt-4 inline-block bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:bg-indigo-700">BROWSE OPEN POSITIONS</a>
                </div>
                <div class="bg-green-100 min-h-[300px] bg-cover bg-center" :style="{ backgroundImage: 'url(/images/image3.jpg)' }"></div>
                <div class="bg-stash-400 min-h-[300px]">
                    <div class="h-1/2 bg-cover bg-center" :style="{ backgroundImage: 'url(/images/image2.jpg)' }"></div>
                    <div class="bg-gray-900 py-2 px-10 text-white h-1/2">
                        <h3 class="text-2xl font-semibold mb-1">What does AIDREN do?</h3>
                        <p class="mb-2">AIDREN is The World's Insight Network, bringing decision makers the insight it takes to get ahead.</p>
                        <a href="#" class="inline-block bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-lg hover:bg-indigo-700">BROWSE OPEN POSITIONS</a>
                    </div>
                </div>
            </div>
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
            <p class="mt-4 text-gray-600 text-center">Have questions? We'd love to hear from you!</p>
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

/* Add this new style */
video {
  object-fit: cover;
  width: 100%;
  height: 100%;
}
</style>
