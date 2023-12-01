<template>
  <div class="row justify-content-md-center mt-5">
    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4">Sign In</h5>
          <form @submit.prevent="loginAction">
            <p v-if="validationErrors.NotApproved" class="text-center">
              <small class="text-danger">{{ validationErrors['NotApproved'] }}</small>
            </p>
            <div v-for="field in formFields" :key="field.name" class="mb-3">
              <label :for="field.name" class="form-label">{{ field.label }}</label>
              <input v-model="formData[field.name]" :type="field.type" :id="field.name" :name="field.name" class="form-control" />
              <div v-if="validationErrors[field.name]" class="flex flex-col">
                <small class="text-danger">{{ validationErrors[field.name][0] }}</small>
              </div>
            </div>
            <div class="d-grid gap-2">
              <button :disabled="isSubmitting" type="submit" class="btn btn-primary btn-block">Login</button>
              <p class="text-center">Don't have an account? <router-link to="/register">Register here</router-link></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
import { useAxios } from '../API/queries';

export default {
  name: 'LoginForm',
  data() {
    return {
      formData: {
        email: '',
        password: '',
      },
      validationErrors: {},
      isSubmitting: false,
      formFields: [
        { name: 'email', label: 'Email address', type: 'email' },
        { name: 'password', label: 'Password', type: 'password' },
      ],
    };
  },
  created() {
    if (localStorage.getItem('token')) {
      this.$router.push('/v1');
    }
  },
  methods: {
    async loginAction() {
      this.isSubmitting = true;
      const { loginAPI } = useAxios();
      try {
        const response = await loginAPI(this.formData);
        const userLoginInfo = await response.data;
        console.log(userLoginInfo)
        if (userLoginInfo.status === 'success') {
          localStorage.setItem('token', userLoginInfo.authorisation.token);
          localStorage.setItem('user', JSON.stringify(userLoginInfo.user));
          const userType = userLoginInfo.user.user_type_id;
          this.$router.push(userType === 1 ? '/admin' : '/v1');
        } else {
          this.isSubmitting = false;
          this.validationErrors = { NotApproved: userLoginInfo.status };
        }
      } catch (error) {
        this.isSubmitting = false;
        if (error.response.data.errors) {
          this.validationErrors = error.response.data.errors;
        }
      }
    },
  },
};
</script>
