<template>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-brand text-white fw-bold" href="#">Logo</div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0"  v-if="this.isAdmin">
            <li class="nav-item">
                <router-link to="/admin" class="nav-link">User Report</router-link>
            </li>
            <li class="nav-item">
                <router-link to="/certificates_report" class="nav-link">Certificates Report</router-link>
            </li>
        </ul>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0"  v-else>
            <li class="nav-item">
                <router-link to="/" class="nav-link text-white">Certificates</router-link>
            </li>
            <li class="nav-item">
                <router-link to="/add-certificate" class="nav-link text-white">Add New</router-link>
            </li>
        </ul>
        <div class="d-flex">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link to="/edit-profile" class="nav-link text-white">Edit Profile</router-link>
                </li>
                <li class="nav-item">
                    <a @click="logoutAction()" class="nav-link text-white " aria-current="page" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </div>
    </div>
</nav>
</template>
  
<script>
import { useAxios } from '../API/queries';
  
export default {
  name: 'home page',
  created() {
    const userData = localStorage.getItem('user');
    if (userData) {
      this.user = JSON.parse(userData);
      if (this.user.user_type_id === 1) {
      this.isAdmin = true;
    } else {
      this.isAdmin = false;
    }
    }
  },
  methods: {
      async logoutAction () {
        const {logoutAPI}=useAxios()
        try {
            await logoutAPI()
            localStorage.setItem('token', "")
            this.$router.push('/')
        } catch (error) {
            console.log(error)
        }
    }
 
  },
};
</script>
<style>
.navbar{
    background-color: royalblue;
    color: #ffff;
}
</style>