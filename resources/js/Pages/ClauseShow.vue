<template>
    <WebLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ article.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <article>
                        <header class="mb-4">
                            <h1 class="text-3xl font-bold mb-2">{{ article.title }}</h1>
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <span class="mr-3">{{ article.author }}</span>
                                <span>{{ formatDate(article.published_at) }}</span>
                            </div>
                            <div class="mb-2">
                                <span v-for="tag in article.tags" :key="tag" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    #{{ tag }}
                                </span>
                            </div>
                        </header>

                        <div class="prose max-w-none mb-8 w-full" v-html="article.content"></div>

                        <div v-if="article.media && article.media.length > 0">
                            <!-- Image Attachments -->
                            <div v-if="imageAttachments.length > 0">
                                <h3 class="text-xl font-semibold mb-4">Image Attachments</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div v-for="media in imageAttachments" :key="media.id" class="mb-4">
                                        <img :src="media.original_url" :alt="media.file_name" class="w-full h-48 object-cover rounded-lg shadow-md">
                                    </div>
                                </div>
                            </div>

                            <!-- Non-Image Attachments -->
                            <div v-if="nonImageAttachments.length > 0">
                                <h3 class="text-xl font-semibold mb-4 mt-8">Other Attachments</h3>
                                <ul class="space-y-2">
                                    <li v-for="media in nonImageAttachments" :key="media.id">
                                        <a :href="media.original_url" download class="flex items-center p-4 bg-gray-100 rounded-lg shadow-md hover:bg-gray-200 transition">
                                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            {{ media.file_name }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </WebLayout>
</template>

<script>
import { defineComponent } from 'vue';
import WebLayout from '@/Layouts/WebLayout.vue';

export default defineComponent({
    components: {
        WebLayout,
    },
    props: {
        article: Object,
    },
    computed: {
        imageAttachments() {
            return this.article.media.filter(media => this.isImage(media.mime_type));
        },
        nonImageAttachments() {
            return this.article.media.filter(media => !this.isImage(media.mime_type));
        },
    },
    methods: {
        formatDate(date) {
            return new Date(date).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        },
        isImage(mimeType) {
            return mimeType.startsWith('image/');
        },
    },
});
</script>

<style scoped>
.prose {
    max-width: 100% !important;
}
</style>
