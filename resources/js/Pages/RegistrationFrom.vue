<script>
import WebLayout from '@/Layouts/WebLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

export default {
  components: {
    WebLayout,
  },
  props: ["competition", "programs", "teams"],
  data() {
    return {
      dateFormat: "YYYY-MM-DD",
      formState:{user: {
            name: '',
            age: undefined,
            email: '',
            website: '',
            introduction: '',
        },
      },
      modal: {
        isOpen: false,
        mode: null,
        title: "Record Modal",
        data: {},
      },
      columns: [
        {
          title: "Team",
          dataIndex: "team",
        },
        {
          title: "Name",
          dataIndex: "name_display",
        },
        {
          title: "Gender",
          dataIndex: "gender",
        },
        {
          title: "Program",
          dataIndex: "program",
        },
        {
          title: "Operation",
          dataIndex: "operation",
        },
      ],
      rules: {
        country: { required: true },
        name: { required: true },
        date_start: { required: true },
        date_end: { required: true },
      },
      validateMessages: {
        required: "${label} is required!",
        types: {
          email: "${label} is not a valid email!",
          number: "${label} is not a valid number!",
        },
        number: {
          range: "${label} must be between ${min} and ${max}",
        },
      },
      layout:{
         labelCol: {
            span: 4,
        },
        wrapperCol: {
            span: 20,
        },
      }
      
    };
  },
  created() {
  },
  methods: {
    onFinish(){

    }
  },
};
</script>

<template>
    <WebLayout title="Registration">


    <!-- About Section -->
    <section class="max-w-7xl mx-auto py-20 px-4">
        <a-form
            :model="formState"
            v-bind="layout"
            name="nest-messages"
            :validate-messages="validateMessages"
            @finish="onFinish"
        >
            <a-form-item :name="['user', 'name']" label="Name" :rules="[{ required: true }]">
                <a-input v-model:value="formState.user.name" type="input" />
            </a-form-item>
            <a-form-item :name="['user', 'email']" label="Email" :rules="[{ type: 'email' }]">
                <a-input v-model:value="formState.user.email" type="input" />
            </a-form-item>
            <a-form-item :name="['user', 'age']" label="Age" :rules="[{ type: 'number', min: 0, max: 99 }]">
                <a-input-number v-model:value="formState.user.age" type="input" />
            </a-form-item>
            <a-form-item :name="['user', 'website']" label="Website">
                <a-input v-model:value="formState.user.website" type="input" />
            </a-form-item>
            <a-form-item :name="['user', 'introduction']" label="Introduction">
                <a-textarea v-model:value="formState.user.introduction" type="input" />
            </a-form-item>
            <a-form-item :wrapper-col="{ ...layout.wrapperCol, offset: 8 }">
                <a-button type="primary" html-type="submit">Submit</a-button>
            </a-form-item>
        </a-form>
    </section>


    <!-- Footer -->
    <footer class="bg-amber-800 text-white py-4">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; 2024 AI Dispute Resolution Expert Network. All rights reserved.</p>
        </div>
    </footer>
    </WebLayout>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
