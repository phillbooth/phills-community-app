<script setup lang="ts">
import { defineProps } from 'vue';
import ReplyForm from '@/Components/ReplyForm.vue';
import CommentsSection from '@/Components/CommentsSection.vue';

interface Comment {
  id: string;
  body: string;
  user?: { name: string };
  replies?: Comment[];
}

const props = defineProps<{
  comments: Comment[];
}>();
</script>

<template>
  <div class="space-y-4">
    <div v-for="comment in props.comments" :key="comment.id" class="border rounded shadow p-4">
      <p class="text-gray-800">
       
        {{ comment.body }}
      </p>
      <ReplyForm :parentId="comment.id" />
      <div v-if="comment.replies && comment.replies.length" class="mt-4 ml-6">
        <CommentsSection :comments="comment.replies" />
      </div>
    </div>
  </div>
</template>
