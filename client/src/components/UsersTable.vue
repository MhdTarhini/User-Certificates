<template>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Blood Type</th>
        <th>Gender</th>
        <th>Last Login</th>
        <th>Approved</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="user in users" :key="user.id">
        <td>{{ user.id }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.bloodType }}</td>
        <td>{{ user.gender }}</td>
        <td>{{ user.lastLogin }}</td>
        <td>{{ user.isApproved }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { useAxios } from '../API/queries';
export default {
  data() {
    return {
      users: [],
    };
  },
  async created() {
    const {getUsersReportAPI}=useAxios()
    try {
        const response = await getUsersReportAPI()
        const UsersInfo=await response.data
        console.log(response)
        console.log(UsersInfo)
    } catch (error) {
        console.log(error)
    }
  },
};
</script>

<style>
table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  border: 1px solid #ddd;
  padding: 8px;
}

th {
  background-color: #f2f2f2;
}
</style>
