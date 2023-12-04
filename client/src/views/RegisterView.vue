<template>
    <main class="center">
        <UserDataForm mode="Register"/>
    </main>
</template>

<script>
import UserDataForm from '../components/UserDataForm.vue'
  export default {
    name: "Register",
    components: {
      UserDataForm,
    },
  }
</script>