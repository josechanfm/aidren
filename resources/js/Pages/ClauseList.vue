<template>
  <WebLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        articles
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a-typography-title :level="3">Recommended Clause for Mediation</a-typography-title>
        <div class="flex flex-wrap -mx-2">
          <template v-for="item in articles.data" :key="item.id">
            <div class="w-full md:w-1/2 px-2 py-2">
              <!-- Adjust column width here -->
              <div class="flex bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-2">
                  <h3 class="text-xl font-semibold mb-2">{{ item.title }}</h3>
                  <div class="flex items-center text-sm text-gray-500 mb-2">
                    <span class="mr-3">{{ item.author }}</span>
                    <span>{{ formatDate(item.published_at) }}</span>
                  </div>
                  <p class="text-gray-600 mb-2">
                    {{ truncateContent(item.content) }}
                  </p>
                  <inertia-link
                    :href="route('clause.show', item.id)"
                    class="text-blue-500 hover:underline"
                  >
                    Read more
                  </inertia-link>
                </div>
              </div>
            </div>
          </template>
        </div>
        <div class="mt-6 flex justify-end">
          <Pagination :links="articles.links" />
        </div>
      </div>
    </div>
  </WebLayout>
</template>

<script>
import { defineComponent } from "vue";
import WebLayout from "@/Layouts/WebLayout.vue";
import Pagination from "@/Components/Pagination.vue";

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
      return new Date(date).toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
    },
    truncateContent(content, maxLength = 150) {
      return content.length > maxLength
        ? content.substring(0, maxLength) + "..."
        : content;
    },
  },
});
</script>
