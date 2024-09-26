<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { DesktopOutlined, MobileOutlined } from '@ant-design/icons-vue';

const props = defineProps({
    sessions: Array,
});

const confirmingLogout = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmLogout = () => {
    confirmingLogout.value = true;

    setTimeout(() => {
        passwordInput.value.focus();
    }, 250);
};

const logoutOtherBrowserSessions = () => {
    form.delete(route('other-browser-sessions.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingLogout.value = false;
    form.reset();
};
</script>

<template>
    <a-row :gutter="16">
        <a-col :span="12">
            <h3 class="text-lg font-medium text-gray-900">Browser Sessions</h3>
            <p class="mt-1 text-sm text-gray-600">
                Manage and log out your active sessions on other browsers and devices.
            </p>
        </a-col>

        <a-col :span="12">
            <div class="max-w-xl text-sm text-gray-600">
                If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.
            </div>

            <div v-if="sessions.length > 0" class="mt-5 space-y-6">
                <div v-for="(session, i) in sessions" :key="i" class="flex items-center">
                    <div class="text-2xl"> <!-- Increased icon container size -->
                        <desktop-outlined v-if="session.agent.is_desktop" :style="{ fontSize: '24px' }" />
                        <mobile-outlined v-else :style="{ fontSize: '24px' }" />
                    </div>

                    <div class="ml-3">
                        <div class="text-sm text-gray-600">
                            {{ session.agent.platform ? session.agent.platform : 'Unknown' }} - {{ session.agent.browser ? session.agent.browser : 'Unknown' }}
                        </div>

                        <div>
                            <div class="text-xs text-gray-500">
                                {{ session.ip_address }},

                                <span v-if="session.is_current_device" class="text-green-500 font-semibold">This device</span>
                                <span v-else>Last active {{ session.last_active }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-5">
                <a-button type="primary" @click="confirmLogout">
                    Log Out Other Browser Sessions
                </a-button>
            </div>

            <!-- Log Out Other Devices Confirmation Modal -->
            <a-modal
                v-model:visible="confirmingLogout"
                title="Log Out Other Browser Sessions"
                @ok="logoutOtherBrowserSessions"
                @cancel="closeModal"
                :okButtonProps="{ loading: form.processing }"
            >
                <p>
                    Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.
                </p>

                <a-form-item class="mt-4">
                    <a-input-password
                        ref="passwordInput"
                        v-model:value="form.password"
                        placeholder="Password"
                        @keyup.enter="logoutOtherBrowserSessions"
                    />
                </a-form-item>
            </a-modal>
        </a-col>
    </a-row>
</template>

<style scoped>
/* You can add any additional custom styles here if needed */
</style>
