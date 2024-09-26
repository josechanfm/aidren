<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';

const props = defineProps({
  experiences: Array,
  portfolioId: Number,
});

const editModalVisible = ref(false);
const addModalVisible = ref(false);

const form = useForm({
  id: null,
  position: '',
  company: '',
  duration: '',
});

const editExperience = (experience) => {
  console.log('editExperience function called', experience);
  form.id = experience.id;
  form.position = experience.position;
  form.company = experience.company;
  form.duration = experience.duration;
  editModalVisible.value = true;
};

const addExperience = () => {
  console.log('addExperience function called');
  form.reset();
  addModalVisible.value = true;
};

const cancelEdit = () => {
  console.log('cancelEdit function called');
  editModalVisible.value = false;
  form.reset();
};

const cancelAdd = () => {
  console.log('cancelAdd function called');
  addModalVisible.value = false;
  form.reset();
};

const saveExperience = () => {
  console.log('saveExperience function called', form.data());
  router.put(route('member.portfolio.experiences.update', [props.portfolioId, form.id]), form.data(), {
    preserveScroll: true,
    onSuccess: () => {
      editModalVisible.value = false;
      form.reset();
    },
  });
};

const createExperience = () => {
  console.log('createExperience function called', form.data());
  router.post(route('member.portfolio.experiences.store', props.portfolioId), form.data(), {
    preserveScroll: true,
    onSuccess: () => {
      addModalVisible.value = false;
      form.reset();
    },
  });
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
        <template v-if="column.key === 'action'">
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

    <!-- Edit Experience Modal -->
    <a-modal
      v-model:open="editModalVisible"
      title="Edit Experience"
      @ok="saveExperience"
      @cancel="cancelEdit"
    >
      <a-form :model="form">
        <a-form-item label="Position">
          <a-input type="input" v-model:value="form.position" />
        </a-form-item>
        <a-form-item label="Company">
          <a-input type="input" v-model:value="form.company" />
        </a-form-item>
        <a-form-item label="Duration">
          <a-input type="input" v-model:value="form.duration" />
        </a-form-item>
      </a-form>
    </a-modal>

    <!-- Add Experience Modal -->
    <a-modal
      v-model:open="addModalVisible"
      title="Add Experience"
      @ok="createExperience"
      @cancel="cancelAdd"
    >
      <a-form :model="form">
        <a-form-item label="Position">
          <a-input type="input" v-model:value="form.position" />
        </a-form-item>
        <a-form-item label="Company">
          <a-input type="input" v-model:value="form.company" />
        </a-form-item>
        <a-form-item label="Duration">
          <a-input type="input" v-model:value="form.duration" />
        </a-form-item>
      </a-form>
    </a-modal>
  </a-card>
</template>
