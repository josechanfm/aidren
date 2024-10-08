<template>
    <WebLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                articles
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="space-y-6">
                        <div v-for="item in articles.data" :key="item.id" class="flex bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="w-1/4 min-w-[150px]">
                                <img 
                                    :src="item.media && item.media.length > 0 ? item.media[0].original_url : '/images/logo.png'" 
                                    :alt="item.title" 
                                    class="w-full h-full object-cover"
                                >
                            </div>
                            <div class="w-3/4 p-4">
                                <h3 class="text-xl font-semibold mb-2">{{ item.title }}</h3>
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <span class="mr-3">{{ item.author }}</span>
                                    <span>{{ formatDate(item.published_at) }}</span>
                                </div>
                                <p class="text-gray-600 mb-2">{{ truncateContent(item.content) }}</p>
                                <inertia-link :href="route('news.show', item.id)" class="text-blue-500 hover:underline">
                                    Read more
                                </inertia-link>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <Pagination :links="articles.links" />
                    </div>
                </div>
            </div>
        </div>
    </WebLayout>
</template>

<script>
import { defineComponent } from 'vue';
import WebLayout from '@/Layouts/WebLayout.vue';
import Pagination from '@/Components/Pagination.vue';

export default defineComponent({
    components: {
        WebLayout,
        Pagination,
    },
    props: {
        articles: Object,
    },
    methods: {
        formatDate(date) {
            return new Date(date).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        },
        truncateContent(content, maxLength = 150) {
            return content.length > maxLength ? content.substring(0, maxLength) + '...' : content;
        },
    },
});
</script>
