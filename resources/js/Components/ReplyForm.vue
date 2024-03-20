<template>
  <div class="reply-form">
    <form @submit.prevent="submitReply">
      <textarea v-model="replyBody" class="w-full rounded border shadow p-2" rows="2" placeholder="Write a reply..."></textarea>
      <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded shadow">Reply</button>
    </form>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  parentId: String,
});
const emit = defineEmits(['replyAdded']);

const replyBody = ref('');

const submitReply = () => {
  Inertia.post(`/comments/${props.parentId}/replies`, { body: replyBody.value }, {
    onSuccess: (response) => {
      replyBody.value = ''; // Clear the text area
      emit('replyAdded', { parent_id: props.parentId, ...response.props.comment });
    },
    onError: (errors) => {
      console.error(errors);
    }
  });
};
</script>
