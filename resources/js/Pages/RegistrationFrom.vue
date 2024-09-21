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
      user: {
        name: '',
        age: undefined,
        email: '',
        country: '',
        timezone: '',
        introduction: '',
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
      layout: {
        labelCol: { span: 6 },
        wrapperCol: { span: 18 },
      },
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
    <section class="max-w-3xl mx-auto py-20 px-4">
        <a-form
            :model="formState"
            :label-col="layout.labelCol"
            :wrapper-col="layout.wrapperCol"
            name="registration-form"
            :validate-messages="validateMessages"
            @finish="onFinish"
        >
            <a-form-item name="name" label="Name" :rules="[{ required: true }]">
                <a-input v-model:value="user.name" type="input" />
            </a-form-item>
            <a-form-item name="email" label="Email" :rules="[{ type: 'email' }]">
                <a-input v-model:value="user.email" type="input" />
            </a-form-item>
            <a-row :gutter="16">
                <a-col :span="12">
                    <a-form-item name="country" label="Country">
                        <a-input v-model:value="user.country" type="input" />
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item name="timezone" label="Timezone">
                        <a-input v-model:value="user.timezone" type="input" />
                    </a-form-item>
                </a-col>
            </a-row>
            <a-form-item name="introduction" label="Introduction">
                <a-textarea v-model:value="user.introduction" />
            </a-form-item>
            <a-form-item :wrapper-col="{ span: 18, offset: 6 }">
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

<style scoped>
.ant-form-item {
    margin-bottom: 24px;
}

/* Add these styles to adjust the layout for Country and Timezone */
.ant-row .ant-form-item .ant-form-item-label {
    flex: 0 0 33.33%;
    max-width: 33.33%;
}

.ant-row .ant-form-item .ant-form-item-control {
    flex: 0 0 66.67%;
    max-width: 66.67%;
}
</style>
