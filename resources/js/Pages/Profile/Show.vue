<script setup>
import { defineProps } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import { Card, Divider } from 'ant-design-vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <a-card v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <UpdateProfileInformationForm :user="$page.props.auth.user" />
                </a-card>

                <a-divider v-if="$page.props.jetstream.canUpdatePassword" />

                <a-card v-if="$page.props.jetstream.canUpdatePassword" class="mt-10 sm:mt-0">
                    <UpdatePasswordForm />
                </a-card>

                <a-divider v-if="$page.props.jetstream.canManageTwoFactorAuthentication" />

                <a-card v-if="$page.props.jetstream.canManageTwoFactorAuthentication" class="mt-10 sm:mt-0">
                    <TwoFactorAuthenticationForm
                        :requires-confirmation="confirmsTwoFactorAuthentication"
                        :user="$page.props.auth.user"
                    />
                </a-card>

                <a-divider />

                <a-card class="mt-10 sm:mt-0">
                    <LogoutOtherBrowserSessionsForm :sessions="sessions" />
                </a-card>

                <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                    <a-divider />

                    <a-card class="mt-10 sm:mt-0">
                        <DeleteUserForm />
                    </a-card>
                </template>
            </div>
        </div>
    </AppLayout>
</template>
