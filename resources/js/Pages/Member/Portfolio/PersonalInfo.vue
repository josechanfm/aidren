<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';

const props = defineProps({
  personalInfo: Object,
});
const form = useForm({
  name: props.personalInfo.name,
  email: props.personalInfo.contactInformation,
  avatar: null,
});

const passwordForm = useForm({
  password: '',
});

const isEditing = ref(false);
const fileInput = ref(null);
const passwordModalOpen = ref(false);  // Changed from passwordModalVisible

const toggleEdit = () => {
  console.log('toggleEdit function called');
  isEditing.value = !isEditing.value;
};

const submit = () => {
  console.log('submit function called');
  form.post(route('member.portfolios.update'), {
    preserveScroll: true,
    onSuccess: () => {
      console.log('submit onSuccess callback');
      isEditing.value = false;
    },
  });
};
const handleAvatarChange = (e) => {
  console.log('handleAvatarChange function called');
  const file = e.target.files[0];
  form.avatar = file;
};
const triggerFileInput = () => {
  console.log('triggerFileInput function called');
  fileInput.value.click();
};
const showPasswordModal = () => {
  passwordModalOpen.value = true;  // Changed from passwordModalVisible
};
const confirmPassword = () => {
  router.post(route('member.profile'), passwordForm , {
    preserveScroll: true,
    onSuccess: () => {
      passwordModalOpen.value = false;  // Changed from passwordModalVisible
      window.location = route('profile.show');
    },
    onError: () => {
      passwordForm.reset();
    },
  });
};
</script>
<template>
  <a-card :bordered="false">
    <template #title>
      <div class="flex justify-between items-center">
        <span>Personal Information</span>
        <div>
          <template v-if="!isEditing">
            <a-button @click="showPasswordModal" class="mr-2">Advanced</a-button>
            <a-button type="primary" @click="toggleEdit">Edit</a-button>
          </template>
          <template v-else>
            <a-button class="mr-2" @click="toggleEdit">Cancel</a-button>
            <a-button type="primary" @click="submit">Save</a-button>
          </template>
        </div>
      </div>
    </template>
    <a-form :model="form">
      <!-- Avatar -->
      <div class="flex items-center mb-4">
        <a-avatar :size="128" :src="personalInfo.profilePicture" />
        <div v-if="isEditing" class="ml-4">
          <input
            type="file"
            ref="fileInput"
            @change="handleAvatarChange"
            accept="image/*"
            class="hidden-file-input"
          />
          <a-button @click="triggerFileInput">
            Change Avatar
          </a-button>
        </div>
      </div>

      <a-form-item label="Name">
        <a-input v-if="isEditing" type="input" v-model:value="form.name" />
        <span v-else>{{ form.name }}</span>
      </a-form-item>
      <a-form-item label="Email">
        <a-input 
          v-if="isEditing" 
          type="input" 
          v-model:value="form.email" 
          :rules="[{ type: 'email', required: true, message: 'Please input a valid email address' }]"
        />
        <span v-else>{{ form.email }}</span>
      </a-form-item>
    </a-form>
  </a-card>
  <!-- Password Confirmation Modal -->
  <a-modal
    v-model:open="passwordModalOpen"  
    title="Confirm Password"
    @ok="confirmPassword"
    :okText="'Confirm'"
  >
    <a-form :model="passwordForm">
      <a-form-item label="Password">
        <a-input-password v-model:value="passwordForm.password" />
        <p class="mt-2 text-sm text-gray-600">
          Please provide your current password before accessing advanced features.
        </p>
      </a-form-item>
    </a-form>
  </a-modal>
</template>
<style scoped>
.hidden-file-input {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
</style>
