<template>
  <div class="row justify-content-md-center mt-5">
    <h2 class="text-center p-3">Add Certificate</h2>
    <div class="col-4">
        <AddCertificateFrom/>
    </div>
  </div>
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
