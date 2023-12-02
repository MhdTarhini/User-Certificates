<template>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Logo</a>
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
                            <router-link to="/" class="nav-link">Certificates</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/add-certificate" class="nav-link">Add New</router-link>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <router-link to="/edit-profile" class="nav-link">Edit Profile</router-link>
                            </li>
                            <li class="nav-item">
                                <a @click="logoutAction()" class="nav-link " aria-current="page" href="#">Logout</a>
                            </li>
                        </ul>
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