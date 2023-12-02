<template>
  <main>
    <div>Users Report</div>
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
