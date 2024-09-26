<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route('current-user.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.reset();
};
</script>

<template>
    <a-row :gutter="16">
        <a-col :span="12">
            <h3 class="text-lg font-medium text-gray-900">Delete Account</h3>
            <p class="mt-1 text-sm text-gray-600">
                Permanently delete your account.
            </p>
        </a-col>

        <a-col :span="12">
            <p class="mt-1 text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
            </p>

            <div class="mt-5">
                <a-button type="primary" danger @click="confirmUserDeletion">
                    Delete Account
                </a-button>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <a-modal
                v-model:visible="confirmingUserDeletion"
                title="Delete Account"
                @ok="deleteUser"
                @cancel="closeModal"
                :okButtonProps="{ danger: true, loading: form.processing }"
                okText="Delete Account"
                cancelText="Cancel"
            >
                <p class="text-sm text-gray-600">
                    Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                </p>

                <a-form-item class="mt-4">
                    <a-input-password
                        ref="passwordInput"
                        v-model:value="form.password"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                    />
                </a-form-item>
            </a-modal>
        </a-col>
    </a-row>
</template>
