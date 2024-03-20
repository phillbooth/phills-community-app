<template>
  <div class="container mt-3">
    <div class="row"> <!-- Bootstrap row to contain the columns -->
      <signup-form></signup-form>
      <login-form></login-form>
    </div>
  </div>
</template>

<script>
import SignupForm from './components/SignupForm.vue';
import LoginForm from './components/LoginForm.vue';

export default {
  components: {
    SignupForm,
    LoginForm
  }
};
</script>
