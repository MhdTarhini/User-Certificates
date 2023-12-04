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
  <div v-if="userCertificates.length===0">
      <div className="page-empty">
        <div className="empty-title">No Certificates</div>
        <router-link to="/add-certificate" class="submit nav-link text-white">Add Certificate</router-link>
      </div>
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
            console.log(userCertificates)
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
<style>
.page-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    border-radius: 8px;
    width: 600px;
    position: absolute;
    top: 300px;
    left: 500px;
}

.empty-title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.empty-text {
    font-size: 16px;
    color: #777;
    text-align: center;
    max-width: 300px;
    margin-bottom: 20px;
}</style>
