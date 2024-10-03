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
                        <a-button type="primary" @click="$inertia.visit(route('admin.news.create'))">
                            Add News
                        </a-button>
                    </div>
                    <a-table 
                        :columns="columns" 
                        :data-source="news.data" 
                        :pagination="pagination"
                        @change="handleTableChange"
                    >
                        <template #bodyCell="{ column, record }">
                            <template v-if="column.key === 'action'">
                                <div class="flex space-x-2">
                                    <a-button @click="$inertia.visit(route('admin.news.edit', record.id))">
                                        Edit
                                    </a-button>
                                    <a-popconfirm
                                        title="Are you sure you want to delete this news item?"
                                        @confirm="$inertia.visit(route('admin.news.destroy', record.id), { method: 'delete' })"
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
        news: Object,
    },
    data() {
        return {
            columns: [
                {
                    title: 'Title',
                    dataIndex: 'title',
                    key: 'title',
                },
                {
                    title: 'Author',
                    dataIndex: 'author',
                    key: 'author',
                },
                {
                    title: 'Published At',
                    dataIndex: 'published_at',
                    key: 'published_at',
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
                total: this.news.total,
                current: this.news.current_page,
                pageSize: this.news.per_page,
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
        handleTableChange(pag) {
            this.$inertia.get(route('admin.news.index'), {
                page: pag.current,
                per_page: pag.pageSize,
            }, {
                preserveState: true,
                preserveScroll: true,
            });
        },
    },
};
</script>