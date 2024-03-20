<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, Link } from '@inertiajs/vue3';

const { props } = usePage();
const { articles } = props; // Deconstruct articles from props
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Latest Articles</h3>
                        <ul class="mt-5 space-y-4">
                        <li v-for="article in articles" :key="article.id">
                            <Link :href="`/articles/${article.id}`" class="text-blue-500 hover:underline">
                            {{ article.title }}
                            </Link>
                        </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
