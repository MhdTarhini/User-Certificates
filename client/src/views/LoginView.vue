<template>
  <main class="center">
    <LoginForm />
  </main>
</template>

<script>
  import LoginForm from '../components/LoginForm.vue'
  export default {
    name: "Login",
    components: {
      LoginForm,
    },
  }
</script>