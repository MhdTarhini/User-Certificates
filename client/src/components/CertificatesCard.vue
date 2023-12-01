<template>
  <div class="card">
    <div class="card-body d-flex flex-column align-item-center">
      <h5 class="card-title">{{ certificate.certificate_name }}</h5>
      <h6 class="card-subtitle mb-2 text-body-secondary">{{ certificate.user_certificate_details.name }}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary">{{ certificate.user_certificate_details.university }}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary">{{ certificate.user_certificate_details.date_achieved }}</h6>
      <button class="btn btn-danger" @click="deleteCertificate(certificate.id)">Delete</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    certificate: Object,
    index: Number,
    deleteCertificate: Function,
  },
};
</script>

<style scoped>
.card {
  width: 18rem;
}
</style>
