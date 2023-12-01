<template>
      <div class="row justify-content-md-center">
        <div class="col-12">
            <Navbar/>
            <div class="container mt-5">
                <router-view></router-view>
            </div>
        </div>
      </div>
</template>
  
<script>
import { useAxios } from '../API/queries';
import Navbar from '../components/Navbar.vue';
  
export default {
    name: 'layout',
    data() {
        return {
            user: {},
        };
    },
    created() {
        if (localStorage.getItem('token') == "" || localStorage.getItem('token') == null) {
            this.$router.push('/');
        }
    },
    methods: {
        async logoutAction() {
            const { logoutAPI } = useAxios();
            try {
                await logoutAPI();
                localStorage.setItem('token', "");
                this.$router.push('/');
            }
            catch (error) {
                console.log(error);
            }
        }
    },
    components: { Navbar }
};
</script>