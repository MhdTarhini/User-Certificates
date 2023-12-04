<template>
  <main>
    <div class="header-title">Users Report</div>
    <UsersTable/>
  </main>
</template>

<script >
import UsersTable from '../components/UsersTable.vue'

export default {
    name:"AdminDashboard",
    components:{
        UsersTable,
    }
}
</script>
