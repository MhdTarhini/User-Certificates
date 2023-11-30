<template>
  <div class="row justify-content-md-center mt-5">
    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4">Register</h5>
          <form @submit.prevent="registerAction">
            <div v-for="field in formFields" :key="field.name" class="mb-3">
              <label :for="field.name" class="form-label">{{ field.label }}</label>
              <select v-if="field.type === 'select'" v-model="formData[field.name]" :id="field.name" :name="field.name" class="form-select">
                <option v-for="option in field.options" :key="option.value" :value="option.value">{{ option.label }}</option>
              </select>
              <input v-else-if="field.type === 'text' || field.type === 'password'" :type="field.type" v-model="formData[field.name]" :id="field.name" :name="field.name" class="form-control">
              <div v-if="validationErrors[field.name]" class="flex flex-col">
                <small class="text-danger">{{ validationErrors[field.name][0] }}</small>
              </div>
            </div>
            <div class="d-grid gap-2">
              <button :disabled="isSubmitting" type="submit" class="btn btn-primary btn-block">Register Now</button>
              <p class="text-center">Have already an account <router-link to="/">Login here</router-link></p>
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
  name: 'RegisterForm',
  data() {
    return {
      formFields: [
        { name: 'name', label: 'Name', type: 'text' },
        { name: 'email', label: 'Email address', type: 'text' },
        { name: 'password', label: 'Password', type: 'password' },
        { name: 'bloodType', label: 'Blood Type', type: 'select', options: [
            { label: 'Select Blood Type', value: '' },
            { label: 'A+', value: 'A+' },
            { label: 'A-', value: 'A-' },
            { label: 'B+', value: 'B+' },
            { label: 'O+', value: 'O+' },
            { label: 'O-', value: 'O-' },
          ]
        },
        { name: 'gender', label: 'Gender', type: 'select', options: [
            { label: 'Select Gender', value: '' },
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
  methods: {
    async registerAction() {
      this.isSubmitting = true;
      const { registerAPI } = useAxios();
      
      try {
        const response = await registerAPI(this.formData);
        const registerUser = await response.data;
        if (registerUser.status === "success") {
          this.$router.push('/login');
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
