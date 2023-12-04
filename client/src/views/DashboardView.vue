<template>
    <main>
            <div class="header-title">{{user?.name}}'s Certificates !</div>
            <CertificateContainer/>
      </main>
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
