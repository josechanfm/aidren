<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

defineProps({
    title: String,
});

const isMenuOpen = ref(false);

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};
</script>

<template>
    <div>
        <Head :title="title" />
        <div class="min-h-screen bg-gray-100">
            <!-- Navbar -->
            <nav style="background-color: #D2C6B6;" class="border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <inertia-link :href="route('home')" class="flex-shrink-0">
                                <ApplicationLogo class="block h-9 w-auto" />
                            </inertia-link>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:items-center">
                            <inertia-link :href="route('services')" class="text-amber-800 hover:text-amber-900 px-3 py-2 rounded-md text-sm font-medium">Services</inertia-link>
                            <inertia-link :href="route('approach')" class="text-amber-800 hover:text-amber-900 px-3 py-2 rounded-md text-sm font-medium">Approach</inertia-link>
                            <inertia-link :href="route('mediators')" class="text-amber-800 hover:text-amber-900 px-3 py-2 rounded-md text-sm font-medium">Mediators</inertia-link>
                            <inertia-link :href="route('aboutUs')" class="text-amber-800 hover:text-amber-900 px-3 py-2 rounded-md text-sm font-medium">About Us</inertia-link>
                            <inertia-link :href="route('contact')" class="text-amber-800 hover:text-amber-900 px-3 py-2 rounded-md text-sm font-medium">Contact</inertia-link>
                            <template v-if="$page.props.auth.user">
                                <inertia-link :href="route('member.dashboard')" class="text-amber-800 hover:text-amber-900 px-3 py-2 rounded-md text-sm font-medium">Dashboard</inertia-link>
                            </template>
                            <template v-else>
                                <inertia-link :href="route('login')" class="text-amber-800 hover:text-amber-900 px-3 py-2 rounded-md text-sm font-medium">Login</inertia-link>
                                <inertia-link :href="route('registration.index')" class="text-amber-800 hover:text-amber-900 px-3 py-2 rounded-md text-sm font-medium">Register</inertia-link>
                            </template>
                        </div>
                        <div class="-mr-2 flex items-center sm:hidden">
                            <template v-if="$page.props.auth.user">
                                <inertia-link :href="route('member.dashboard')" class="text-amber-800 hover:text-amber-900 px-3 py-2 rounded-md text-sm font-medium">Dashboard</inertia-link>
                            </template>
                            <template v-else>
                                <inertia-link :href="route('login')" class="text-amber-800 hover:text-amber-900 px-1 py-2 rounded-md text-sm font-medium">Login</inertia-link>
                                <inertia-link :href="route('registration.index')" class="text-amber-800 hover:text-amber-900 px-1 py-2 rounded-md text-sm font-medium">Register</inertia-link>
                            </template>
                            <button @click="toggleMenu" class="inline-flex items-center justify-center p-2 rounded-md text-amber-800 hover:text-amber-900 hover:bg-amber-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-amber-500">
                                <span class="sr-only">Open main menu</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path v-if="!isMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu, show/hide based on menu state. -->
                <div :class="{ 'block': isMenuOpen, 'hidden': !isMenuOpen }" class="sm:hidden bg-amber-100">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <inertia-link :href="route('services')" class="text-amber-800 hover:text-amber-900 block px-3 py-2 rounded-md text-base font-medium">Services</inertia-link>
                        <inertia-link :href="route('approach')" class="text-amber-800 hover:text-amber-900 block px-3 py-2 rounded-md text-base font-medium">Approach</inertia-link>
                        <inertia-link :href="route('mediators')" class="text-amber-800 hover:text-amber-900 block px-3 py-2 rounded-md text-base font-medium">Mediators</inertia-link>
                        <inertia-link :href="route('aboutUs')" class="text-amber-800 hover:text-amber-900 block px-3 py-2 rounded-md text-base font-medium">About Us</inertia-link>
                        <inertia-link :href="route('contact')" class="text-amber-800 hover:text-amber-900 block px-3 py-2 rounded-md text-base font-medium">Contact</inertia-link>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
