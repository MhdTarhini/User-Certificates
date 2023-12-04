<template>
  <main>
    <div class="header-title">Certificates Report</div>
    <div class="d-flex flex-column gap-4">
      <AddCertificateType @certificateAdded="addCertificate" />
      <CertificatesReport :certificates="certificates" />
    </div>
  </main>
</template>

<script>
import AddCertificateType from '../components/AddCertificateType.vue';
import CertificatesReport from '../components/CertificatesReport.vue';
import { useAxios } from '../API/queries';

export default {
  name: "AdminDashboard",
  components: {
    AddCertificateType,
    CertificatesReport,
  },
  data() {
    return {
      certificates: [], 
    };
  },
  async created() {
  const {getCertificatesReportAPI}=useAxios()
  try {
      const response = await getCertificatesReportAPI()
      const certificatesReport=await response.data
      this.certificates = certificatesReport.data
  } catch (error) {
      console.log(error)
  }
},
  methods: {
    addCertificate(certificateType) {
      this.certificates.push({ 
        id: certificateType.id, 
        name: certificateType.name, 
        user_certificates_count: 0 
      });
    }
  }
};
</script>


