<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                News
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="space-y-6">
                        {{ $page.props.auth.user }}
                        <div v-for="item in news.data" :key="item.id" class="flex bg-white shadow-md rounded-lg overflow-hidden">
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
                                <div class="mb-2">
                                    <span v-for="tag in item.tags" :key="tag" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                        #{{ tag }}
                                    </span>
                                </div>
                                <p class="text-gray-600 mb-2">{{ truncateContent(item.content) }}</p>
                                <a :href="route('news.show', item.id)" class="text-blue-500 hover:underline">Read more</a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <Pagination :links="news.links" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { defineComponent } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';

export default defineComponent({
    components: {
        AppLayout,
        Pagination,
    },
    props: {
        news: Object,
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
