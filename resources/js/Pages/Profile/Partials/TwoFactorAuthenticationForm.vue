<script setup>
import { ref, computed } from 'vue';
import { useForm, router } from '@inertiajs/vue3';

const props = defineProps({
    requiresConfirmation: Boolean,
    user: Object,
});

const enabling = ref(false);
const confirming = ref(false);
const disabling = ref(false);
const qrCode = ref(null);
const setupKey = ref(null);
const recoveryCodes = ref([]);

const confirmationForm = useForm({
    code: '',
});

const twoFactorEnabled = computed(() => {
    return !enabling.value && props.user.two_factor_enabled;
});

const passwordForm = useForm({
    password: '',
});

const showPasswordPrompt = ref(false);

const confirmPassword = () => {
    passwordForm.post(route('password.confirm'), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            showPasswordPrompt.value = false;
            enableTwoFactorAuthentication();
        },
        onError: () => {
            passwordForm.reset();
        },
    });
};

const enableTwoFactorAuthentication = () => {
    enabling.value = true;

    router.post('/user/two-factor-authentication', {}, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => Promise.all([
            showQrCode(),
            showSetupKey(),
            showRecoveryCodes(),
        ]),
        onFinish: () => {
            enabling.value = false;
            confirming.value = props.requiresConfirmation;
        },
        onError: (error) => {
            if (error.response && error.response.status === 423) {
                showPasswordPrompt.value = true;
            }
        },
    });
};

const showQrCode = () => {
    return axios.get('/user/two-factor-qr-code').then(response => {
        qrCode.value = response.data.svg;
    });
};

const showSetupKey = () => {
    return axios.get('/user/two-factor-secret-key').then(response => {
        setupKey.value = response.data.secretKey;
    });
};

const showRecoveryCodes = () => {
    return axios.get('/user/two-factor-recovery-codes').then(response => {
        recoveryCodes.value = response.data;
    });
};

const confirmTwoFactorAuthentication = () => {
    confirmationForm.post('/user/confirmed-two-factor-authentication', {
        errorBag: 'confirmTwoFactorAuthentication',
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            confirming.value = false;
            qrCode.value = null;
            setupKey.value = null;
        },
    });
};

const regenerateRecoveryCodes = () => {
    axios.post('/user/two-factor-recovery-codes').then(() => {
        showRecoveryCodes();
    });
};

const disableTwoFactorAuthentication = () => {
    disabling.value = true;

    router.delete('/user/two-factor-authentication', {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            disabling.value = false;
            confirming.value = false;
        },
    });
};
</script>

<template>
    <a-row :gutter="16">
        <a-col :span="12">
            <h3 class="text-lg font-medium text-gray-900">Two Factor Authentication</h3>
            <p class="mt-1 text-sm text-gray-600">
                Add additional security to your account using two factor authentication.
            </p>
        </a-col>

        <a-col :span="12">
            <h3 v-if="twoFactorEnabled && !confirming" class="text-lg font-medium text-gray-900">
                You have enabled two factor authentication.
            </h3>

            <h3 v-else-if="twoFactorEnabled && confirming" class="text-lg font-medium text-gray-900">
                Finish enabling two factor authentication.
            </h3>

            <h3 v-else class="text-lg font-medium text-gray-900">
                You have not enabled two factor authentication.
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application.
                        </p>
                    </div>

                    <div class="mt-4" v-html="qrCode"></div>
                </div>

                <div v-if="setupKey">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <a-form v-if="!twoFactorEnabled" @submit.prevent="enableTwoFactorAuthentication">
                    <a-button type="primary" :loading="enabling" html-type="submit">
                        Enable
                    </a-button>
                </a-form>

                <template v-else>
                    <a-form v-if="confirming" @submit.prevent="confirmTwoFactorAuthentication">
                        <div class="mt-4 max-w-xl text-sm text-gray-600">
                            <p class="font-semibold">
                                To finish enabling two factor authentication, scan the following QR code using your phone's authenticator application or enter the setup key and provide the generated OTP code.
                            </p>
                        </div>

                        <div class="mt-4">
                            <a-input-password v-model:value="confirmationForm.code" placeholder="Code" />
                        </div>

                        <div class="mt-4 flex items-center space-x-2">
                            <a-button type="primary" :disabled="confirmationForm.processing" html-type="submit">
                                Confirm
                            </a-button>

                            <a-button :disabled="confirmationForm.processing" @click="confirming = false">
                                Cancel
                            </a-button>
                        </div>
                    </a-form>

                    <div v-else>
                        <div class="mt-4 max-w-xl text-sm text-gray-600">
                            <p class="font-semibold">
                                Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application or enter the setup key.
                            </p>
                        </div>

                        <div class="mt-4">
                            <a-button type="primary" @click="regenerateRecoveryCodes">
                                Regenerate Recovery Codes
                            </a-button>
                        </div>

                        <div class="mt-4">
                            <a-button type="primary" danger @click="disableTwoFactorAuthentication" :loading="disabling">
                                Disable
                            </a-button>
                        </div>
                    </div>
                </template>
            </div>
        </a-col>
    </a-row>

    <a-modal
        v-model:visible="showPasswordPrompt"
        title="Confirm Password"
        @ok="confirmPassword"
    >
        <a-form :model="passwordForm">
            <a-form-item
                label="Password"
                name="password"
                :rules="[{ required: true, message: 'Please input your password!' }]"
            >
                <a-input-password v-model:value="passwordForm.password" />
            </a-form-item>
        </a-form>
    </a-modal>
</template>
