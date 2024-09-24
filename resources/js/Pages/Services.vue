<script setup>
import WebLayout from '@/Layouts/WebLayout.vue';
import { Head } from '@inertiajs/vue3';

const services = [
    {
        title: "Mediation",
        description: "Our expert mediators facilitate discussions between parties to reach mutually agreeable solutions. We provide a neutral, confidential environment to address conflicts effectively.",
        icon: "balance-scale"
    },
    {
        title: "Arbitration",
        description: "Our arbitration services offer a binding resolution process. Experienced arbitrators review evidence and arguments to make fair and impartial decisions.",
        icon: "gavel"
    },
    {
        title: "Negotiation Support",
        description: "We provide skilled negotiators to assist parties in reaching agreements. Our experts guide discussions, ensuring all parties' interests are considered.",
        icon: "handshake"
    },
    {
        title: "Conflict Coaching",
        description: "One-on-one coaching sessions to help individuals develop conflict resolution skills and strategies for managing disputes effectively.",
        icon: "user-graduate"
    },
    {
        title: "Workplace Dispute Resolution",
        description: "Specialized services for resolving conflicts in professional environments, including team mediation and organizational conflict assessments.",
        icon: "building"
    },
    {
        title: "Online Dispute Resolution (ODR)",
        description: "Leveraging technology to provide efficient and accessible dispute resolution services remotely, ensuring convenience for all parties involved.",
        icon: "laptop"
    }
];

const testimonials = [
    {
        quote: "The mediation process was incredibly smooth and effective. We reached a resolution that satisfied all parties involved.",
        author: "John Doe",
        company: "Tech Solutions Inc.",
        image: "https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=256&q=80"
    },
    {
        quote: "The online dispute resolution platform made it easy for our remote team to resolve conflicts efficiently.",
        author: "Jane Smith",
        company: "Global Innovations Ltd.",
        image: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=256&q=80"
    },
    {
        quote: "The arbitration service provided a fair and impartial decision, allowing us to move forward with our project.",
        author: "Michael Johnson",
        company: "Construction Experts Co.",
        image: "https://images.unsplash.com/photo-1566492031773-4f4e44671857?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=256&q=80"
    }
];
</script>

<template>
    <WebLayout>
        <Head title="Our Services" />

        <div class="py-12 bg-gray-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Our Services</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="service in services" :key="service.title" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <i :class="`fas fa-${service.icon} text-3xl text-indigo-600 mr-4`"></i>
                                <h2 class="text-2xl font-semibold text-gray-800">{{ service.title }}</h2>
                            </div>
                            <p class="text-gray-600">{{ service.description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonials Section -->
                <section class="mt-32 mb-32 relative overflow-hidden">
                    <div class="max-w-7xl mx-auto">
                        <div class="relative z-10 bg-white rounded-3xl shadow-xl overflow-hidden">
                            <div class="absolute inset-0 bg-indigo-100 opacity-70" style="background-image: url('https://www.transparenttextures.com/patterns/diamond-upholstery.png'); background-repeat: repeat;"></div>
                            <div class="relative z-20 py-20 px-8">
                                <h2 class="text-4xl font-bold text-center text-gray-800 mb-16">Success Stories</h2>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                                    <div v-for="testimonial in testimonials" :key="testimonial.author" class="bg-white p-8 rounded-xl shadow-lg transform transition duration-500 hover:scale-105">
                                        <div class="flex flex-col items-center mb-6">
                                            <img :src="testimonial.image" :alt="testimonial.author" class="w-24 h-24 rounded-full mb-4 border-4 border-indigo-500 shadow-md">
                                            <h3 class="font-semibold text-xl text-center text-gray-800">{{ testimonial.author }}</h3>
                                            <p class="text-indigo-600 text-sm text-center font-medium">{{ testimonial.company }}</p>
                                        </div>
                                        <p class="text-gray-700 italic text-center text-lg leading-relaxed">"{{ testimonial.quote }}"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="mt-12 text-center">
                    <p class="text-xl text-gray-700 mb-6">Need a customized solution for your dispute?</p>
                    <a href="/contact" class="bg-indigo-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-indigo-700 transition duration-300">
                        Contact Us for Consultation
                    </a>
                </div>
            </div>
        </div>
    </WebLayout>
</template>

<style scoped>
.testimonial-bg {
    background-image: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
    background-size: cover;
    background-position: center;
}
</style>
