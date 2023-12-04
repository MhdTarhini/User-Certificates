<template>
  <div class="row justify-content-md-center justify-content-center mt-5">
  <form class="form" @submit.prevent="handleUserInfo">
    <p class="title">{{ mode === 'Register' ? 'Register' : 'Update Profile' }}</p>
    <p class="message">{{ mode === 'Register' ? 'Signup now and get full access to our app.' : 'Update your profile information.' }}</p>
    <div v-for="field in formFields" :key="field.name" class="div">
      <template v-if="field.type === 'text' || field.type === 'email' || field.type === 'password'" >
        <label>
          <input v-model="formData[field.name]" :type="field.type" placeholder="" class="input" :required="mode === 'Register' ? true : false">
          <span>{{ field.label }}</span>
        </label>
        <div v-if="validationErrors[field.name]" class="flex flex-col">
                <small class="text-danger">{{ validationErrors[field.name][0] }}</small>
              </div>
      </template>

      <template v-if="field.type === 'select'">
        <label>
          <select v-model="formData[field.name]" class="input" :required="true">
            <option v-for="option in field.options" :key="option.value" :value="option.value">{{ option.label }}</option>
          </select>
          <span>{{ field.label }}</span>
        </label>
        
      </template>
    </div>

    <button :disabled="isSubmitting" type="submit" class="submit">{{ mode }}</button>
    <p v-if="mode === 'Register'" class="signin">Already have an account?<router-link to="/">Sign in</router-link></p>
  </form>
    </div>

</template>
<script>
import { useAxios } from '../API/queries';


export default {
  name: 'RegisterForm',
  props: {
    mode: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      formFields: [
        { name: 'name', label: 'Name', type: 'text' },
        { name: 'email', label: 'Email address', type: 'text' },
        { name: 'password', label: 'Password', type: 'password' },
        { name: 'bloodType', label: 'Blood Type', type: 'select', options: [
            { label: 'A+', value: 'A+' },
            { label: 'A-', value: 'A-' },
            { label: 'B+', value: 'B+' },
            { label: 'O+', value: 'O+' },
            { label: 'O-', value: 'O-' },
          ]
        },
        { name: 'gender', label: 'Gender', type: 'select', options: [
            { label: 'Male', value: 'male' },
            { label: 'Female', value: 'female' },
          ]
        },
      ],
      formData: {
        name: '',
        email: '',
        password: '',
        bloodType: '',
        gender: '',
      },
      validationErrors: {},
      isSubmitting: false,
    };
  },
  created(){
    if (this.mode === 'Update') {
      this.user = JSON.parse(localStorage.getItem('user'));
      this.formData = {
        name: this.user?.name || '',
        email: this.user?.email || '',
        bloodType: this.user?.blood_type || '',
        gender: this.user?.gender || '',
      };
    }
  },
  methods: {
    async handleUserInfo() {
      const toast = useToast();
      this.isSubmitting = true;
      const { AddAndUpdateUserInfoAPI } = useAxios();
      
      try {
        const response = await AddAndUpdateUserInfoAPI(this.formData,this.mode);
        const registerUser = await response.data;
        if (registerUser.status === "success") {
          toast.success('You did it!');
          this.mode === 'Register' ? 
          this.$router.push('/') :
          localStorage.setItem('user', JSON.stringify(registerUser.data));
        }
      } catch (error) {
        this.isSubmitting = false;
        if (error.response.data.errors !== undefined) {
          this.validationErrors = error.response.data.errors;
        }
      }
    }
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