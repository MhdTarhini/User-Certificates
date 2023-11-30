<template>
  <div class="row justify-content-md-center mt-5">
    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4">Sign In</h5>
          <form>
            <div class="mb-3">
              <label htmlFor="email" class="form-label">
                Email address
                </label>
              <input v-model="email" type="email" class="form-control" id="email" name="email" />
            </div>
            <div class="mb-3">
              <label htmlFor="password" class="form-label">Password
              </label>
              <input v-model="password" type="password" class="form-control" id="password" name="password" />
            </div>
            <div class="d-grid gap-2">
              <button :disabled="isSubmitting" @click="loginAction()" type="button"
                class="btn btn-primary btn-block">Login</button>
               <p class="text-center">Don't have account?
                <router-link to="/register">Register here </router-link>
                </p>
            </div>
          </form>
        </div>
        </div>
    </div>
  </div>
</template>
  
<script>
export default {
  name: 'LoginForm',
  data() {
    return {
      email: '',
      password: '',
      isSubmitting: false,
    };
  },
  methods: {
    loginAction() {
      this.isSubmitting = true
      let UserInfo = {
        email: this.email,
        password: this.password,
      }
    }
  },
};
</script>