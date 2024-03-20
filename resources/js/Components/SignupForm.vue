<template>
  <div class="col-md-6">
  <h2>Signup</h2>
    <form class="signup-form" @submit.prevent="submitForm">
      <div class="mb-3">
        <label for="signup-name" class="form-label">Name</label>
        <input type="text" class="form-control" id="signup-name" v-model="name" required placeholder="Enter your name">
      </div>
      <div class="mb-3">
        <label for="signup-email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="signup-email" v-model="email" required placeholder="Enter email">
      </div>
      <div class="mb-3">
        <label for="signup-password" class="form-label">Password</label>
        <input type="password" class="form-control" id="signup-password" v-model="password" required placeholder="Create a password">
      </div>
      <div class="mb-3">
        <label for="signup-password-confirm" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="signup-password-confirm" v-model="password_confirmation" required placeholder="Repeat your password">
      </div>
      <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'SignupForm',
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    };
  },
  methods: {
    async submitForm() {
      // Logic to submit form data to your Laravel backend
      // You might use this.$axios.post('/register', { ... }) if using axios, for example
    },
  },
};
</script>

<style scoped>
/* Add styles for your signup form here */
</style>
