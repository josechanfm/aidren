<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('user-password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <a-row :gutter="16">
        <a-col :span="12">
            <h3 class="text-lg font-medium text-gray-900">Update Password</h3>
            <p class="mt-1 text-sm text-gray-600">
                Ensure your account is using a long, random password to stay secure.
            </p>
        </a-col>

        <a-col :span="12">
            <a-form :model="form" @finish="updatePassword">
                <a-form-item
                    label="Current Password"
                    name="current_password"
                    :rules="[{ required: true, message: 'Please input your current password!' }]"
                >
                    <a-input-password
                        ref="currentPasswordInput"
                        v-model:value="form.current_password"
                        autocomplete="current-password"
                    />
                </a-form-item>

                <a-form-item
                    label="New Password"
                    name="password"
                    :rules="[{ required: true, message: 'Please input your new password!' }]"
                >
                    <a-input-password
                        ref="passwordInput"
                        v-model:value="form.password"
                        autocomplete="new-password"
                    />
                </a-form-item>

                <a-form-item
                    label="Confirm Password"
                    name="password_confirmation"
                    :rules="[
                        { required: true, message: 'Please confirm your new password!' },
                        ({ getFieldValue }) => ({
                            validator(_, value) {
                                if (!value || getFieldValue('password') === value) {
                                    return Promise.resolve();
                                }
                                return Promise.reject('The two passwords do not match!');
                            },
                        }),
                    ]"
                >
                    <a-input-password
                        v-model:value="form.password_confirmation"
                        autocomplete="new-password"
                    />
                </a-form-item>

                <a-form-item>
                    <a-button type="primary" html-type="submit" :loading="form.processing">
                        Save
                    </a-button>
                </a-form-item>
            </a-form>
        </a-col>
    </a-row>
</template>
