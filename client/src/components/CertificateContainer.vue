<template>
  <div class="d-flex flex-wrap gap-3">
    <CertificateCard
      v-for="(certificate, index) in userCertificates"
      :key="index"
      :certificate="certificate"
      :index="index"
      :deleteCertificate="deleteCertificate"
    />
  </div>
</template>

<script>
import { useAxios } from '../API/queries';
import CertificateCard from './CertificatesCard.vue';

export default {
  name: "CertificateContainer",
  components: {
    CertificateCard,
  },
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
            const userCertificates=await response.data
            if(userCertificates.status=="success"){
                this.userCertificates = userCertificates.data
            }
        } catch (error) {
            console.log(error)
        }
    },
    async deleteCertificate(certificateId) {
        const {deleteUserCertificates}=useAxios()
        try {
            await deleteUserCertificates(certificateId);
            this.userCertificates = this.userCertificates.filter(cert => cert.id !== certificateId);
        } catch (error) {
            console.log(error)
        }
    },
  },
};
</script>
