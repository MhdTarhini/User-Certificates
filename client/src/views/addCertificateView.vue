<template >
  <main class="center">
    <div class="header-title">Add Certificate</div>
    <AddCertificateFrom/>

  </main>
</template>

<script>
import AddCertificateFrom from '../components/AddCertificateFrom.vue';

export default {
  name: 'addCertificate',
  components: {
    AddCertificateFrom,
  },
};
</script>
