<template>
  <div class="col-md-6">
    <h2>Login</h2>
    <form class="login-form" @submit.prevent="submitLogin">
      <div class="mb-3">
        <label for="login-email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="login-email" v-model="loginForm.email" required placeholder="name@example.com">
      </div>
      <div class="mb-3">
        <label for="login-password" class="form-label">Password</label>
        <input type="password" class="form-control" id="login-password" v-model="loginForm.password" required>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember-me" v-model="loginForm.remember">
        <label class="form-check-label" for="remember-me">Remember me</label>
      </div>
      <button type="submit" class="btn btn-primary">Log In</button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'LoginForm',
  data() {
    return {
      loginForm: {
        email: '',
        password: '',
        remember: false
      }
    };
  },
  methods: {
    async submitLogin() {
      try {
        // Here you would add your logic to submit the form data.
        // For a Laravel backend, this would typically involve sending a request to your Laravel application's login endpoint.
        // Replace `your_login_endpoint` with the actual endpoint URL.
        // Example with fetch API:
        await fetch('/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest', // Important for Laravel to recognize the request as AJAX
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Assuming you have a CSRF token meta tag in your HTML
          },
          body: JSON.stringify(this.loginForm)
        });

        // Handle success, possibly redirecting the user or storing authentication data
      } catch (error) {
        // Handle error, such as displaying a notification to the user
        console.error('Login failed:', error);
      }
    }
  }
};
</script>

<style scoped>
/* Add styles for your login form here */
</style>
