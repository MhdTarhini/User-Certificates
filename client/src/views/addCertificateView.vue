<template>
  <div class="row justify-content-md-center mt-5">
    <div class="col-4">
        <div class="card-body">
          <form @submit.prevent="addCertificateAction">
            <div v-for="field in formFields" :key="field.name" class="mb-3">
              <label :for="field.name" class="form-label">{{ field.label }}</label>
              <select v-if="field.type === 'select'" v-model="formData[field.name]" :id="field.name" :name="field.name" class="form-select">
                <option v-for="option in field.options" :key="option.value" :value="option.value">{{ option.label }}</option>
              </select>
              <input v-else-if="field.type === 'text' || field.type === 'date'" :type="field.type" v-model="formData[field.name]" :id="field.name" :name="field.name" class="form-control">
              <div v-if="validationErrors[field.name]" class="flex flex-col">
                <small class="text-danger">{{ validationErrors[field.name][0] }}</small>
              </div>
            </div>
            <div class="d-grid gap-2">
              <button :disabled="isSubmitting" type="submit" class="btn btn-primary btn-block">Add New</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</template>

<script>
import { useAxios } from '../API/queries';

export default {
  name: 'addCertificate',
  data() {
    return {
      formFields: [
        { name: 'certificateType', label: 'Certificate Type', type: 'select', options: []},
        { name: 'name', label: 'Name', type: 'text' },
        { name: 'university', label: 'University', type: 'text' },
        { name: 'archievedDate', label: 'Archieved date', type: 'date' },
        
      ],
      formData: {
        name: '',
        university: '',
        certificateType: '',
        archievedDate: '',
      },
      validationErrors: {},
      isSubmitting: false,
    };
  },
  created() {
    this.getCertificateTypes();
  },
  methods: {
    async getCertificateTypes() {
      const { getCertificateTypesAPI } = useAxios();
      try {
        const response = await getCertificateTypesAPI();
        const certificateTypes = response.data;
        this.formFields[0].options = certificateTypes.data.map(type => ({
          label: type.name,
          value: type.name,
        }));
      } catch (error) {
        console.log(error);
      }
    },
    async addCertificateAction() {
      this.isSubmitting = true;
      
      try {
        
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
