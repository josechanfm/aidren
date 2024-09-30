<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isEditMode ? 'Edit News' : 'Create News' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" id="title" v-model="form.title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea id="content" v-model="form.content" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                            <input type="text" id="author" v-model="form.author" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="mb-4">
                            <label for="published_at" class="block text-sm font-medium text-gray-700">Publish Date</label>
                            <input type="datetime-local" id="published_at" v-model="form.published_at" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="mb-4">
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail</label>
                            <input type="file" id="thumbnail" ref="thumbnail" @change="form.thumbnail = $event.target.files[0]">
                        </div>
                        <div class="mb-4">
                            <label for="attachments" class="block text-sm font-medium text-gray-700">Attachments</label>
                            <input type="file" id="attachments" ref="attachments" multiple @change="form.attachments = $event.target.files">
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <inertia-link :href="route('admin.news.index')" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-gray transition ease-in-out duration-150 mr-2">
                                Cancel
                            </inertia-link>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                {{ isEditMode ? 'Update News' : 'Create News' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout,
    },
    props: {
        news: {
            type: Object,
            default: () => ({}),
        },
    },
    setup(props) {
        const form = useForm({
            title: props.news.title || '',
            content: props.news.content || '',
            author: props.news.author || '',
            published_at: props.news.published_at || '',
        });

        const isEditMode = !!props.news.id;

        const submit = () => {
            if (isEditMode) {
                form.put(route('admin.news.update', props.news.id));
            } else {
                form.post(route('admin.news.store'));
            }
        };

        return {
            form,
            isEditMode,
            submit,
        };
    },
};
</script>
