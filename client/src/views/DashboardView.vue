<template>
    <div class="row justify-content-md-center">
        <div class="col-12">
            <h2 class="text-center p-3">Welcome, {{user?.name}}!</h2>
            <CertificateContainer/>
        </div>
      </div>
</template>

<script>
import CertificateContainer from '../components/CertificateContainer.vue';

export default {
  name: "Dashboard",
  components: {
    CertificateContainer,
  },
  data() {
    return {
      user: null,
    };
  },
  created() {
    const userData = localStorage.getItem('user');
    if (userData) {
      this.user = JSON.parse(userData);
    }
  },
}
</script>
