<template>
  <div class="d-flex ">
    <div v-for="(certificate, index) in userCertificates" :key="index" class="p-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ certificate.name }}</h5>
          <h6 class="card-subtitle mb-2 text-body-secondary">{{ certificate.type }}</h6>
          <h6 class="card-subtitle mb-2 text-body-secondary">{{ certificate.university }}</h6>
          <h6 class="card-subtitle mb-2 text-body-secondary">{{ certificate.date }}</h6>
          <button class="btn btn-danger" @click="deleteCertificate(certificate.id)">Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {useAxios} from '../API/queries'

export default {
  name: "Dashboard",
  data() {
    return {
      userCertificates: [], 
    };
  },
  created() {
    this.fetchUserCertificates();
  },
  methods: {
    async fetchUserCertificates() {
        const {getUserCertificates}=useAxios()
        try {
            const response = await getUserCertificates();
            console.log(response)
        } catch (error) {
            console.log(error)
        }
    },
    
    async deleteCertificate(certificateId) {
        const {deleteUserCertificates}=useAxios()
        try {
            await deleteUserCertificates(certificateId);
        } catch (error) {
            console.log(error)
        }
    },
  },
};
</script>
