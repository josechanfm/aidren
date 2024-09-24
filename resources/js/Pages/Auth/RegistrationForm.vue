<script setup>
import { useForm } from '@inertiajs/vue3';
import WebLayout from '@/Layouts/WebLayout.vue';

const form = useForm({
  name: '',
  country: '',
  timezone: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('register'));
};

// You might want to replace this with a more comprehensive list
const countries = ['USA', 'Canada', 'UK', 'Australia', 'Germany', 'France', 'Japan', 'China'];
const timezones = ['UTC-12:00', 'UTC-11:00', 'UTC-10:00', 'UTC-09:00', 'UTC-08:00', 'UTC-07:00', 'UTC-06:00', 'UTC-05:00', 'UTC-04:00', 'UTC-03:00', 'UTC-02:00', 'UTC-01:00', 'UTC+00:00', 'UTC+01:00', 'UTC+02:00', 'UTC+03:00', 'UTC+04:00', 'UTC+05:00', 'UTC+06:00', 'UTC+07:00', 'UTC+08:00', 'UTC+09:00', 'UTC+10:00', 'UTC+11:00', 'UTC+12:00'];
</script>

<template>
  <WebLayout>
    <div class="max-w-2xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
      <h2 class="text-2xl font-semibold mb-6 text-center">Registration</h2>
      <a-form 
        :model="form" 
        @finish="submit" 
        :label-col="{ style: { width: '150px' } }" 
        :wrapper-col="{ style: { width: 'calc(100% - 150px)' } }"
      >
        <a-form-item label="Name" name="name" :rules="[{ required: true, message: 'Please input your name!' }]">
          <a-input type="input" v-model:value="form.name" />
        </a-form-item>
        <a-row :gutter="16">
          <a-col :span="12">
            <a-form-item label="Country" name="country" :rules="[{ required: true, message: 'Please select your country!' }]">
              <a-select v-model:value="form.country">
                <a-select-option v-for="country in countries" :key="country" :value="country">
                  {{ country }}
                </a-select-option>
              </a-select>
            </a-form-item>
          </a-col>
          <a-col :span="12">
            <a-form-item label="Timezone" name="timezone" :rules="[{ required: true, message: 'Please select your timezone!' }]">
              <a-select v-model:value="form.timezone">
                <a-select-option v-for="timezone in timezones" :key="timezone" :value="timezone">
                  {{ timezone }}
                </a-select-option>
              </a-select>
            </a-form-item>
          </a-col>
        </a-row>

        <a-form-item label="Email" name="email" :rules="[{ required: true, type: 'email', message: 'Please input a valid email!' }]">
          <a-input type="input" v-model:value="form.email" />
        </a-form-item>

        <a-form-item label="Password" name="password" :rules="[{ required: true, message: 'Please input your password!' }]">
          <a-input-password type="input" v-model:value="form.password" />
        </a-form-item>

        <a-form-item label="Confirm Password" name="password_confirmation" :rules="[{ required: true, message: 'Please confirm your password!' }]">
          <a-input-password type="input" v-model:value="form.password_confirmation" />
        </a-form-item>

        <a-form-item :wrapper-col="{ style: { width: '100%' } }">
          <div class="flex flex-col items-center">
            <a-button type="primary" html-type="submit" :loading="form.processing">Register</a-button>
            <InertiaLink :href="route('login')" class="mt-4 text-blue-600 hover:text-blue-800">
              I have an account, bring me to login page.
            </InertiaLink>
          </div>
        </a-form-item>
      </a-form>
    </div>
  </WebLayout>
</template>

<style scoped>
.ant-form-item-label {
  text-align: left;
}
</style>