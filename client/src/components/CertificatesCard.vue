<template>
  <div class="card">
    <div class="card-body d-flex flex-column align-item-center">
      <h5 class="card-title text-primary-emphasis fs-3">{{ certificate.certificate_name }}</h5>
      <h6 class="card-subtitle mb-2 text-black"><span class="signin">Major : </span>{{ certificate.user_certificate_details.major }}</h6>
      <h6 class="card-subtitle mb-2 text-black"><span class="signin">University : </span>{{ certificate.user_certificate_details.university }}</h6>
      <h6 class="card-subtitle mb-2 text-black"><span class="signin">Date : </span>{{ certificate.user_certificate_details.date_achieved }}</h6>
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
  position: relative;
  width: 18rem;
  border-radius: 23px;
  transition: all 0.8s cubic-bezier(0.15, 0.83, 0.66, 1);
}

.card:hover {
  transform: scale(1.05);
}
</style>
