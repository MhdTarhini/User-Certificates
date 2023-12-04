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
        <td>{{ user.blood_type }}</td>
        <td>{{ user.gender }}</td>
        <td>{{ user.last_login ? user.last_login : "-"}}</td>
        <td :class="{'approved' :user.is_approved==1}">
            <button v-if="user.is_approved !== 1" @click="approveUser(user)" class="submit">
              Approve
            </button>
            <div v-else >
            <CheckMarker/> APRROVED
            </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { useAxios } from '../API/queries';
import CheckMarker from './icons/CheckMarker.vue';
export default {
    data() {
        return {
            users: [],
        };
    },
    async created() {
        const { getUsersReportAPI } = useAxios();
        try {
            const response = await getUsersReportAPI();
            const UsersInfo = await response.data;
            this.users = UsersInfo.data;
        }
        catch (error) {
            console.log(error);
        }
    },
    methods: {
        async approveUser(user) {
            const { approveUserAPI } = useAxios();
            try {
                await approveUserAPI(user.id);
                user.is_approved = 1;
            }
            catch (error) {
                console.log(error);
            }
        },
    },
    components: { CheckMarker }
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

.approved{
  color: rgb(14, 190, 14);
}

</style>
