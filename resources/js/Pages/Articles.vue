<template>

  <Head title="Create New Article" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Article</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="submitArticle">
            <div class="mb-4">
              <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
              <input type="text" v-model="article.title" id="title"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required>
              <span v-if="errors.title" class="text-red-600">{{ errors.title }}</span>
            </div>
            <div class="mb-6">
              <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
              <textarea v-model="article.description" id="description" rows="4"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required></textarea>
              <span v-if="errors.description" class="text-red-600">{{ errors.description }}</span>
            </div>
            <button type="submit"
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit
              Article</button>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage } from '@inertiajs/vue3';
const user = usePage().props.auth.user;
const { props } = usePage();
const article = ref({
  title: '',
  description: ''
});
const errors = reactive({});

function submitArticle() {
  Inertia.post('/articles/store', {
    title: article.value.title,
    description: article.value.description
  }, {
    preserveState: true, 
    onSuccess: (page) => {
      Inertia.visit(`/articles/${page.props.articleId}`);
    },
    onError: (err) => {
      errors.value = err;
    }
  });
}



</script>
