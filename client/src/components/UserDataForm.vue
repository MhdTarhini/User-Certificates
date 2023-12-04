<template>
  <form class="form" @submit.prevent="handleUserInfo">
    <p class="title">{{ mode === 'Register' ? 'Register' : 'Update Profile' }}</p>
    <p class="message">{{ mode === 'Register' ? 'Signup now and get full access to our app.' : 'Update your profile information.' }}</p>
    <div v-for="field in formFields" :key="field.name" class="div-fields">
      <template v-if="field.type === 'text' || field.type === 'email' || field.type === 'password'" >
        <label>
          <input v-model="formData[field.name]" :type="field.type" placeholder="" class="input" :required="mode === 'Register' ? true : false">
          <span>{{ field.label }}</span>
        </label>
        <div v-if="validationErrors[field.name]" class="flex">
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

</template>
<script>
import { useAxios } from '../API/queries';
import { successNotification , errorNotification} from './notification/ToastNotification';

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
      valid:true
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
      this.isSubmitting= true
      const { AddAndUpdateUserInfoAPI } = useAxios();
        try {
          const response = await AddAndUpdateUserInfoAPI(this.formData,this.mode);
          const registerUser = await response.data;
          if (registerUser.status === "success") {
            if(this.mode === 'Register'){
              this.$router.push('/') 
            } else{
              localStorage.setItem('user', JSON.stringify(registerUser.data)) 
              successNotification("Your Profile Is Updated");
            }
          }
        } catch (error) {
          if (error.response.data.errors !== undefined) {
            this.validationErrors = error.response.data.errors;
            errorNotification(`There ${Object.keys(this.validationErrors).length} unvalid field`)
          }
        }
    }
  },
  watch: {
  'formData.email'(newVal, oldVal) {
    if (this.validationErrors.email && newVal !== oldVal && newVal.includes('@')) {
      this.isSubmitting = false; 
    }
  },
  'formData.password'(newVal, oldVal) {
    if (this.validationErrors.password && newVal !== oldVal && newVal.length > 6)  {
      this.isSubmitting = false; 
    }
  },
},
}
</script>
