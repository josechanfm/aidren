<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link as InertiaLink } from '@inertiajs/vue3';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />
        <div class="min-h-screen bg-gray-100">
            <!-- Navbar -->
            <nav style="background-color: #D2C6B6;" class="bg-warm-tauque shadow">
                <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center text-amber-900">
                    <ApplicationLogo class="block h-12 w-auto" />
                    <div>
                        <a href="#services" class="hover:text-amber-600 mx-4">Services</a>
                        <a :href="route('about-us')" class=" hover:text-amber-600 mx-4">About Us</a>
                        <a href="#contact" class="hover:text-amber-600 mx-4">Contact</a>
                        <template v-if="$page.props.auth.user">
                            <a href="dashboard" class="hover:text-amber-600 mx-4">Dashboard</a>
                        </template>
                        <template v-else>
                            <a href="dashboard" class="hover:text-amber-600 mx-4" @click="logout()">Login</a>
                            <a href="register" class="hover:text-amber-600 mx-4">Register</a>
                        </template>
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
