<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isEditMode ? 'Edit News' : 'Create News' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a-card class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <a-form
                        :model="news"
                        @finish="submit"
                        :label-col="{ style: { width: '200px' } }"
                        :wrapper-col="{ style: { width: 'calc(100% - 200px)' } }"
                        enctype="multipart/form-data"
                    >
                        <a-form-item label="Title" name="title" :rules="[{ required: true, message: 'Please input the title!' }]">
                            <a-input type="input" v-model:value="news.title" />
                        </a-form-item>
                        <a-form-item label="Content" name="content" :rules="[{ required: true, message: 'Please input the content!' }]">
                            <Editor
                                :api-key="tinymceApiKey"
                                :init="editorInit"
                                v-model="news.content"
                            />
                        </a-form-item>

                        <a-form-item label="Author" name="author">
                            <a-input type="input" v-model:value="news.author" />
                        </a-form-item>

                        <a-form-item label="Publish Date" name="published_at">
                            <a-date-picker
                                v-model:value="news.published_at"
                                show-time
                                format="YYYY-MM-DD HH:mm:ss"
                            />
                        </a-form-item>

                        <a-form-item label="Thumbnail" name="thumbnail">
                            <img v-if="uploaded_thumbnail" :src="uploaded_thumbnail.original_url" width="200"/>
                            <a-upload
                                v-else
                                v-model:file-list="thumbnailList"
                                :custom-request="customThumbnailRequest"
                                list-type="picture"
                                :max-count="1"
                            >
                                <a-button>
                                    <upload-outlined></upload-outlined>
                                    Select Thumbnail
                                </a-button>
                            </a-upload>
                        </a-form-item>
                        <a-form-item label="Attachments" name="attachments">
                            <template v-if="uploaded_attachments && uploaded_attachments.length > 0">
                                <ol>
                                    <li v-for="attachment in uploaded_attachments" :key="attachment.id">
                                        <img :src="attachment.original_url" width="200"/>
                                    </li>
                                </ol>
                                <ul>
                                    <li v-for="attachment in news.attachments" :key="attachment.id">
                                        <img :src="attachment.original_url" width="200">
                                    </li>
                                </ul>
                            </template>
                            <template v-else>
                                <a-upload
                                v-model:file-list="attachmentsList"
                                :custom-request="customAttachmentsRequest"
                                :multiple="true"
                                :max-count="5"

                            >
                                <a-button>
                                    <upload-outlined></upload-outlined>
                                    Select Attachments (Max 5)
                                </a-button>
                            </a-upload>

                            </template>
                        </a-form-item>

                        <a-form-item :wrapper-col="{ offset: 6, span: 18 }">
                            <a-space>
                                <a-button type="primary" html-type="submit">
                                    {{ isEditMode ? 'Update News' : 'Create News' }}
                                </a-button>
                                <a-button @click="$inertia.visit(route('admin.news.index'))">
                                    Cancel
                                </a-button>
                            </a-space>
                        </a-form-item>
                    </a-form>
                </a-card>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import Editor from '@tinymce/tinymce-vue';
import { UploadOutlined } from '@ant-design/icons-vue';
import { message } from 'ant-design-vue';

export default {
    components: {
        AppLayout,
        Editor,
        UploadOutlined,
    },
    props: {
        news: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            uploaded_thumbnail: null,
            uploaded_attachments: null,
            thumbnailList: [],
            attachmentsList: [],
            tinymceApiKey: import.meta.env.VITE_TINYMCE_API_KEY,
            editorInit: {
                height: 300,
                menubar: false,
                plugins: ['link', 'lists', 'autolink', 'table', 'code'],
                toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link table code',
                branding: false,
                readonly: false,
            },
        };
    },
    mounted() {
        //console.log(this.news.media[0]);
            this.uploaded_thumbnail = this.news.media?.find(media => media.collection_name === 'thumbnail');
            this.uploaded_attachments = this.news.media?.filter(media => media.collection_name === 'attachments');
        this.news.attachments=[];
        this.news.attachments=[];
    },
    computed: {
        isEditMode() {
            return !!this.news.id;
        },
    },
    methods: {
        customThumbnailRequest({ file, onSuccess }) {
            this.news.thumbnail = file;
            this.thumbnailList = [file];
            onSuccess();
        },
        customAttachmentsRequest({ file, onSuccess }) {
            this.news.attachments.push(file);
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const newAttachment = {
                        uid: file.uid,
                        name: file.name,
                        status: 'done',
                        url: e.target.result,
                        file: file
                    };

                    this.attachmentsList = [...this.attachmentsList, newAttachment];

                    onSuccess();
                    resolve(true);
                };
                reader.onerror = (error) => {
                    console.error('Error reading file:', error);
                    onError(error);
                    reject(error);
                };
                reader.readAsDataURL(file);
            });
        },
        submit() {
            console.log(this.attachmentsList);

            if (this.isEditMode) {
                this.news._method = 'PATCH';
                this.$inertia.post(route('admin.news.update', this.news.id), this.news, {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: () => message.success('News updated successfully'),
                    onError: (errors) => {
                        console.error('Validation errors:', errors);
                        message.error('Failed to update news. Please check the form and try again.');
                    },
                });
            } else {
                this.news.post(route('admin.news.store'), {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: () => message.success('News created successfully'),
                    onError: (errors) => {
                        console.error('Validation errors:', errors);
                        message.error('Failed to create news. Please check the form and try again.');
                    },
                });
            }
        },
    },
};
</script>

<style scoped>
.ant-form-item-label {
    text-align: left !important;
}

.ant-form-item-control-input-content {
    width: 100%;
}

.ant-input,
.ant-picker,
.ant-upload-list,
.tox-tinymce {
    width: 100% !important;
}
</style>