<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import { CheckCircleOutlined } from '@ant-design/icons-vue';

const dateFormat = 'YYYY-MM-DD';

const props = defineProps({
  experiences: Array,
  portfolioId: Number,
});

const modalVisible = ref(false);
const modalState = ref('CREATE');

const form = useForm({
  id: null,
  position: '',
  company: '',
  start_date: '',
  end_date: '',
  is_current: false,
  description: '',
});

const editExperience = (experience) => {
  console.log('editExperience function called', experience);
  form.id = experience.id;
  form.position = experience.position;
  form.company = experience.company;
  form.start_date = experience.start_date;
  form.end_date = experience.end_date;
  form.is_current = experience.is_current;
  form.description = experience.description;
  modalState.value = 'EDIT';
  modalVisible.value = true;
};

const addExperience = () => {
  console.log('addExperience function called');
  form.reset();
  modalState.value = 'CREATE';
  modalVisible.value = true;
};

const cancelModal = () => {
  console.log('cancelModal function called');
  modalVisible.value = false;
  form.reset();
};

const saveExperience = () => {
  const formData = {
    ...form.data(),
    start_date: form.start_date ? dayjs(form.start_date).tz("Asia/Macao").format('YYYY-MM-DD') : null,
    end_date: form.end_date ? dayjs(form.end_date).tz("Asia/Macao").format('YYYY-MM-DD') : null,
  };

  if (modalState.value === 'EDIT') {
    console.log('saveExperience function called', formData);
    router.put(route('member.portfolio.experiences.update', [props.portfolioId, form.id]), formData, {
      preserveScroll: true,
      onSuccess: () => {
        modalVisible.value = false;
        form.reset();
      },
    });
  } else {
    console.log('createExperience function called', formData);
    router.post(route('member.portfolio.experiences.store', props.portfolioId), formData, {
      preserveScroll: true,
      onSuccess: () => {
        modalVisible.value = false;
        form.reset();
      },
    });
  }
};

const deleteExperience = (experience) => {
  console.log('deleteExperience function called', experience.id);
  router.delete(route('member.portfolio.experiences.destroy', experience.id), {
    preserveScroll: true,
  });
};

const columns = [
  {
    title: 'Position',
    dataIndex: 'position',
    key: 'position',
  },
  {
    title: 'Company',
    dataIndex: 'company',
    key: 'company',
  },
  {
    title: 'Duration',
    dataIndex: 'duration',
    key: 'duration',
  },
  {
    title: 'Current',
    dataIndex: 'is_current',
    key: 'is_current',
  },
  {
    title: 'Action',
    key: 'action',
  },
];
</script>

<template>
  <a-card title="Experiences" :bordered="false">
    <template #extra>
      <a-button type="primary" @click="addExperience">Add Experience</a-button>
    </template>
    <a-table :dataSource="experiences" :columns="columns">
      <template #bodyCell="{ column, record }">
        <template v-if="column.key === 'is_current'">
          <CheckCircleOutlined v-if="record.is_current" style="color: #52c41a; font-size: 18px;" />
        </template>
        <template v-else-if="column.key === 'action'">
          <a-button type="primary" @click="editExperience(record)" class="mr-2">Edit</a-button>
          <a-popconfirm
            title="Are you sure you want to delete this experience?"
            ok-text="Yes"
            cancel-text="No"
            @confirm="deleteExperience(record)"
          >
            <a-button danger>Delete</a-button>
          </a-popconfirm>
        </template>
      </template>
    </a-table>

    <!-- Experience Modal -->
    <a-modal
      v-model:open="modalVisible"
      :title="modalState === 'EDIT' ? 'Edit Experience' : 'Add Experience'"
      @ok="saveExperience"
      @cancel="cancelModal"
    >
      <a-form :model="form" layout="vertical">
        <a-form-item label="Position" name="position">
          <a-input v-model:value="form.position" />
        </a-form-item>
        <a-form-item label="Company" name="company">
          <a-input v-model:value="form.company" />
        </a-form-item>
        <a-form-item label="Start Date" name="start_date">
          <a-date-picker 
            v-model:value="form.start_date" 
            style="width: 100%" 
            :format="dateFormat" :valueFormat="dateFormat"
          />
        </a-form-item>
        <a-form-item label="End Date" name="end_date">
          <a-date-picker 
            v-model:value="form.end_date" 
            style="width: 100%" 
            :disabled="form.is_current"
            :format="dateFormat" :valueFormat="dateFormat"
          />
        </a-form-item>
        <a-form-item name="is_current">
          <a-checkbox v-model:checked="form.is_current">Currently working here</a-checkbox>
        </a-form-item>
        <a-form-item label="Description" name="description">
          <a-textarea v-model:value="form.description" :rows="4" />
        </a-form-item>
      </a-form>
    </a-modal>
  </a-card>
</template>
