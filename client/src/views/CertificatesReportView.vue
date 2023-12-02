<template>
  <main>
    <div>certificates Report</div>
    <div class="d-flex flex-column">
      <AddCertificateType/>
      <CertificatesReport/>
    </div>
  </main>
</template>

<script >
import AddCertificateType from '../components/AddCertificateType.vue'
import CertificatesReport from '../components/CertificatesReport.vue'

export default {
    name:"AdminDashboard",
    components:{
        AddCertificateType,
        CertificatesReport,
    }
}
</script>
