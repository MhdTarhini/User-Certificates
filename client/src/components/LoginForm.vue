<template>
  <div class="row justify-content-md-center justify-content-center mt-5">
  <form class="form" @submit.prevent="loginAction">
    <p class="title">Login</p>
    <p class="message">Welcome Back</p>
     <div v-if="validationErrors.lenght > 0" class="flex flex-col">
          <small class="text-danger">Not Valid Email or Password</small>
      </div>
    <div v-for="field in formFields" :key="field.name" class="div">
        <label>
          <input v-model="formData[field.name]" :type="field.type" placeholder="" class="input" :required="true" >
          <span>{{ field.label }}</span>
        </label>
        
    </div>
   
    <button :disabled="isSubmitting" type="submit" class="submit">Login</button>
    <p>Don't have an account?<router-link to="/register">Sign in</router-link></p>
  </form>
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
          this.$router.push(userType === 1 ? '/admin' : '/v1');
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
<style>
.form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  max-width: 400px;
  background-color: #fff;
  padding: 20px;
  border-radius: 20px;
  position: relative;
}
.div{
   position: relative;
}
.title {
  font-size: 28px;
  color: royalblue;
  font-weight: 600;
  letter-spacing: -1px;
  position: relative;
  display: flex;
  align-items: center;
  padding-left: 30px;
}

.title::before,.title::after {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  border-radius: 50%;
  left: 0px;
  background-color: royalblue;
}

.title::before {
  width: 18px;
  height: 18px;
  background-color: royalblue;
}

.title::after {
  width: 18px;
  height: 18px;
  animation: pulse 1s linear infinite;
}

.message, .signin {
  color: rgba(88, 87, 87, 0.822);
  font-size: 14px;
}

.signin {
  text-align: center;
}

.signin a {
  color: royalblue;
}

.signin a:hover {
  text-decoration: underline royalblue;
}

.flex {
  display: flex;
  width: 100%;
  gap: 6px;
}

.form label {
  width: 100%;

}

.form label .input {
  width: 100%;
  padding: 10px 10px 20px 10px;
  outline: 0;
  border: 1px solid rgba(105, 105, 105, 0.397);
  border-radius: 10px;
}

.form label .input + span {
  position: absolute;
  left: 10px;
  top: 15px;
  color: grey;
  font-size: 0.9em;
  cursor: text;
  transition: 0.3s ease;
}

.form label .input:placeholder-shown + span {
  top: 15px;
  font-size: 0.9em;
}

.form label .input:focus + span,.form label .input:valid + span {
  top: 30px;
  font-size: 0.7em;
  font-weight: 600;
}

.form label .input:valid + span {
  color: green;
}

.submit {
  border: none;
  outline: none;
  background-color: royalblue;
  padding: 10px;
  border-radius: 10px;
  color: #fff;
  font-size: 16px;
  transform: .3s ease;
}

.submit:hover {
  background-color: rgb(56, 90, 194);
}

@keyframes pulse {
  from {
    transform: scale(0.9);
    opacity: 1;
  }

  to {
    transform: scale(1.8);
    opacity: 0;
  }
}
.form label .input {
  appearance: none;
  -webkit-appearance: none;
  padding-right: 30px;
}

.form label select:focus {
  border-color: royalblue;
}

</style>