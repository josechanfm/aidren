<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

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
        <InertiaHead :title="title" />
        <div class="min-h-screen bg-gray-100">
            <!-- Navbar -->
            <nav style="background-color: #D2C6B6;" class="bg-warm-tauque shadow">
                <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center text-amber-900">
                    <InertiaLink :href="route('home')">
                        <ApplicationLogo class="block h-12 w-auto" />
                    </InertiaLink>
                    <div>
                        <InertiaLink :href="route('services')" class="hover:text-amber-600 mx-4">Services</InertiaLink>
                        <InertiaLink :href="route('approach')" class="hover:text-amber-600 mx-4">Approach</InertiaLink>
                        <InertiaLink :href="route('mediators')" class="hover:text-amber-600 mx-4">Mediators</InertiaLink>
                        <InertiaLink :href="route('aboutUs')" class="hover:text-amber-600 mx-4">About Us</InertiaLink>
                        <InertiaLink :href="route('contact')" class="hover:text-amber-600 mx-4">Contact</InertiaLink>
                        <template v-if="$page.props.auth.user">
                            <InertiaLink :href="route('dashboard')" class="hover:text-amber-600 mx-4">Dashboard</InertiaLink>
                        </template>
                        <template v-else>
                            <InertiaLink :href="route('login')" class="hover:text-amber-600 mx-4">Login</InertiaLink>
                            <InertiaLink :href="route('register')" class="hover:text-amber-600 mx-4">Register</InertiaLink>
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
