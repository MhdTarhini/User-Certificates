<template>
  <form class="form" @submit.prevent="addCertificateAction">
    <div v-for="field in formFields" :key="field.name" class="div-fields">
      <template v-if="field.type === 'text'|| field.type === 'date'">
        <label>
          <input :type="field.type" v-model="formData[field.name]" :id="field.name" :name="field.name" placeholder="" class="input" :required=true>
          <span >{{ field.label }}</span>
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
    <button :disabled="isSubmitting" type="submit" class="submit">Save</button>
  </form>

</template>

<script>
import { useAxios } from '../API/queries';
import { successNotification } from './notification/ToastNotification';


export default {
  name: 'addCertificateForm',
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
          value: type.id,
        }));
      } catch (error) {
        console.log(error);
      }
    },
    async addCertificateAction() {
       const {addCertificateAPI}=useAxios()
       this.isSubmitting = true;
      try {
        await addCertificateAPI(this.formData)
        successNotification("Completed !")
        this.formData = {
        name: '',
        university: '',
        certificateType: '',
        archievedDate: '',
      };
      this.isSubmitting = false;
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
input[type=date]:required:invalid::-webkit-datetime-edit {
    color: transparent;
}
input[type=date]:focus::-webkit-datetime-edit {
    color: black !important;
}</style>
