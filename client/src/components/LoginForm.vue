<template>
  <form class="form" @submit.prevent="loginAction">
    <p class="title">Login</p>
    <p class="message">Welcome back !!</p>
     <div v-if="validationErrors.lenght > 0" class="flex">
          <small class="text-danger">Not Valid Email or Password</small>
      </div>
    <div v-for="field in formFields" :key="field.name" class="div-fields">
        <label>
          <input v-model="formData[field.name]" :type="field.type" placeholder="" class="input" :required="true" >
          <span>{{ field.label }}</span>
        </label>
        
    </div>

    <ButtonComponents :isLoading="isloading" :isSubmitting="isSubmitting" :buttonText="'Login'" />
    <p class="signin">Don't have an account?<router-link to="/register" class="ms-2">Register</router-link></p>
  </form>

</template>
<script>
import { useAxios } from '../API/queries';
import ButtonComponents from './ButtonComponent.vue'

export default {
  name: 'LoginForm',
  components: {
      ButtonComponents
    },
  data() {
    return {
      formData: {
        email: '',
        password: '',
      },
      isloading:false,
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
      this.isloading = true
      this.validationErrors= {}
      this.isSubmitting = true;
      const { loginAPI } = useAxios();
      try {
        const response = await loginAPI(this.formData);
        const userLoginInfo = await response.data;
        if (userLoginInfo.status === 'success') {
          localStorage.setItem('token', userLoginInfo.authorisation.token);
          localStorage.setItem('user', JSON.stringify(userLoginInfo.user));
          const userType = userLoginInfo.user.user_type_id;
          setTimeout(()=>{
            this.isloading=false
            this.$router.push(userType === 1 ? '/admin' : '/v1');
          },2000)
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