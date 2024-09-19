<script setup>
import WebLayout from '@/Layouts/WebLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <WebLayout title="Dashboard">
    <!-- Hero Section -->
    <header class="bg-amber-800 text-white py-20">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-4xl font-bold">Empowering Resolution Through Innovation</h1>
            <p class="mt-4 text-lg">Join our community of experts dedicated to resolving disputes efficiently and effectively.</p>
            <a href="#services" class="mt-6 inline-block bg-white text-indigo-600 font-semibold py-2 px-6 rounded-lg shadow-lg hover:bg-gray-100">Explore Services</a>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="max-w-7xl mx-auto py-20 px-4">
        <h2 class="text-3xl font-bold text-center text-amber-800">About Us</h2>
        <p class="mt-4 text-gray-600 text-center">
            Our AI-powered Dispute Resolution Expert Network connects individuals and organizations with skilled professionals.
            We leverage cutting-edge technology to streamline the resolution process, making it faster, fairer, and more accessible for everyone.
        </p>
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
