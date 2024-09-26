<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    email: props.user.email,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);

const updateProfileInformation = () => {
    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const selectNewPhoto = (info) => {
    if (info.file.status === 'done') {
        form.photo = info.file.originFileObj;
        createPhotoPreview();
    } else if (info.file.status === 'error') {
        message.error(`${info.file.name} file upload failed.`);
    }
};

const createPhotoPreview = () => {
    const reader = new FileReader();
    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };
    reader.readAsDataURL(form.photo);
};

const deletePhoto = () => {
    form.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (form.photo) {
        form.photo = null;
    }
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const validateEmail = async (rule, value) => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!value) {
        return Promise.reject('Email is required');
    }
    if (!emailRegex.test(value)) {
        return Promise.reject('Please enter a valid email address');
    }
    return Promise.resolve();
};
</script>

<template>
    <a-form :model="form" @finish="updateProfileInformation">
        <a-row :gutter="16">
            <a-col :span="12">
                <h3 class="text-lg font-medium text-gray-900">Profile Information</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Update your account's profile information and email address.
                </p>
            </a-col>

            <a-col :span="12">
                <div v-if="$page.props.jetstream.managesProfilePhotos">
                    <div class="mt-4">
                        <div v-if="!photoPreview" class="mt-2">
                            <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                        </div>
                        <div v-else class="mt-2">
                            <img :src="photoPreview" class="rounded-full h-20 w-20 object-cover">
                        </div>
                        <a-upload
                            name="photo"
                            :show-upload-list="false"
                            :before-upload="() => false"
                            @change="selectNewPhoto"
                        >
                            <a-button>Select A New Photo</a-button>
                        </a-upload>
                        <a-button v-if="user.profile_photo_path" type="link" @click="deletePhoto">
                            Remove Photo
                        </a-button>
                    </div>
                </div>

                <a-form-item label="Name">
                    <a-input type="input" v-model:value="form.name" />
                </a-form-item>

                <a-form-item
                    label="Email"
                    name="email"
                    :rules="[
                        { required: true, message: 'Please input your email!' },
                        { validator: validateEmail, trigger: 'blur' }
                    ]"
                >
                    <a-input type="input" v-model:value="form.email" />
                </a-form-item>

                <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                    <p class="text-sm mt-2">
                        Your email address is unverified.
                        <a-button type="link" @click.prevent="sendEmailVerification">
                            Click here to re-send the verification email.
                        </a-button>
                    </p>

                    <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        A new verification link has been sent to your email address.
                    </div>
                </div>

                <a-form-item>
                    <a-button type="primary" html-type="submit" :loading="form.processing">Save</a-button>
                </a-form-item>
            </a-col>
        </a-row>
    </a-form>
</template>
