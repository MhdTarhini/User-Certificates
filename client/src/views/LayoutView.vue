<template>
    <Navbar/>
    <div class="container mt-5">
        <router-view></router-view>
    </div>
</template>
  
<script>
import Navbar from '../components/Navbar.vue';
  
export default {
    name: 'layout',
    components: { Navbar },
    created() {
        if (localStorage.getItem('token') == "" || localStorage.getItem('token') == null) {
            this.$router.push('/');
        }
    },
    
};
</script>