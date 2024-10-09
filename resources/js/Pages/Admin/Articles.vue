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
                    <div class="flex justify-end mb-4">
                        <a-button type="primary" @click="$inertia.visit(route('admin.articles.create'))">
                            Add News
                        </a-button>
                    </div>
                    <a-table 
                        :rowKey="(record) => record.id"
                        :data-source="articles.data" 
                        :columns="columns" 
                        :pagination="pagination"
                        @change="handleTableChange"
                    >
                        <template #bodyCell="{ column, record }">
                            <template v-if="column.key === 'action'">
                                <div class="flex space-x-2">
                                    <a-button @click="$inertia.visit(route('admin.articles.edit', record.id))">
                                        Edit
                                    </a-button>
                                    <a-popconfirm
                                        title="Are you sure you want to delete this article item?"
                                        @confirm="$inertia.visit(route('admin.articles.destroy', record.id), { method: 'delete' })"
                                        ok-text="Yes"
                                        cancel-text="No"
                                    >
                                        <a-button type="primary" danger>
                                            Delete
                                        </a-button>
                                    </a-popconfirm>
                                </div>
                            </template>
                        </template>
                    </a-table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout,
    },
    props: {
        categories:Object,
        articles: Object,
    },
    data() {
        return {
            columns: [
                {
                    title: 'Category',
                    dataIndex: 'category',
                    key: 'category',
                    filters: this.categories,
                },
                {
                    title: 'Title',
                    dataIndex: 'title',
                    key: 'title',
                    sorter: true,
                },
                {
                    title: 'Author',
                    dataIndex: 'author',
                    key: 'author',
                    sorter: true,
                },
                {
                    title: 'Published At',
                    dataIndex: 'published_at',
                    key: 'published_at',
                    sorter: true,
                    customRender: ({ text }) => this.formatDate(text),
                },
                {
                    title: 'Actions',
                    key: 'action',
                },
            ],
        };
    },
    computed: {
        pagination() {
            return {
                total: this.articles.total,
                current: this.articles.current_page,
                pageSize: this.articles.per_page,
                showSizeChanger: true,
                showQuickJumper: true,
            };
        },
    },
    methods: {
        formatDate(date) {
            return new Date(date).toLocaleString('en-US', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
            });
        },
        handleTableChange(page, filters, sorter) {
            this.$inertia.get(route('admin.articles.index'), {
                page: page.current,
                per_page: page.pageSize,
                filter:filters,
                sorter:sorter
            }, {
                preserveState: true,
                preserveScroll: true,
            });
        },
    },
};
</script>