<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import CommentsSection from '@/Components/CommentsSection.vue';
import { Inertia } from '@inertiajs/inertia';
const { props } = usePage();
const { article } = props;
const commentForm = useForm({ body: '', parent_id: null }); // Add parent_id for replies

const submitComment = () => {
    commentForm.post(`/articles/${article.id}/comments`, {
        onSuccess: () => {
            commentForm.reset(); 
            Inertia.reload({ only: ['article'], data: { newComment: true } }); // Inertia reload with specifics
           
        },
        onError: (err) => {
            console.error(err);
        },
        onFinish: () => {
            // Code to execute after request finishes regardless of success or error
        }
    });
};
</script>

<template>
    <Head title="View Article" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ article.title }}</h2>
        </template>
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">{{ article.title }}</h3>
                        <p class="mt-2 text-base text-gray-600">{{ article.description }}</p>
                    </div>
                </div>
                <div class="mt-8">
                    <form @submit.prevent="submitComment">
                        <textarea v-model="commentForm.body" class="w-full rounded border shadow p-2" rows="3" placeholder="Leave a comment..."></textarea>
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded shadow">Post Comment</button>
                    </form>
                    <CommentsSection :comments="article.comments" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>