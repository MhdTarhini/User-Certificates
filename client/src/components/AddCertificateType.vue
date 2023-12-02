<template>
  <div class="d-flex align-items-center">
    <div class="input-container">
      <input
        v-model="newCertificateType"
        placeholder="New certificate Type"
        class="input-field"
        type="text"
      />
      <label for="input-field" class="input-label">New certificate Type</label>
      <span class="input-highlight"></span>
    </div>
    <button @click="addNewCertificateType">New</button>
  </div>
</template>

<script>
import {useAxios} from '../API/queries';

export default {
  name: "AddCertificateType",
  data() {
    return {
      newCertificateType: "" 
    };
  },
  methods: {
      async addNewCertificateType() {
        const {addNewCertificateTypeAPI}=useAxios()
        try {
            const response = await addNewCertificateTypeAPI(this.newCertificateType)
            const newCertificate = await response.data;
            this.newCertificateType = '';
        } catch (error) {
        console.error('Error adding certificate type:', error);
        }
    }
  }
};
</script>

<style>
</style>
