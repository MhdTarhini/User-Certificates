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
        <td :class="{ 'approved': user.is_approved === 1, 'not-approved': user.is_approved !== 1, 'approve-toggle-td': true }">
            <button v-if="user.is_approved !== 1" @click="approveUser(user)" class="approve-toggle-btn">
              {{ user.is_approved === 1 ? 'Disapprove' : 'Approve' }}
            </button>
            <div v-else>
            Is Approved
            </div>
        </td>
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
        this.users = UsersInfo.data
    } catch (error) {
        console.log(error)
    }
  },
  methods: {
    async approveUser(user) {
        const {approveUserAPI}=useAxios()
        try {
            await approveUserAPI(user.id)
            user.is_approved=1
        } catch (error) {
            console.log(error)
        }
    },
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

.approve-toggle-td {
  padding: 0 5px 5px 5px;
}

.approve-toggle-btn {
  position: relative;
  border-radius: 5px;
  background-repeat: no-repeat;
  box-sizing: border-box;
  width: 100%;
  color: #fff;
  border: none;
  font-size: 20px;
  transition: all .3s ease-in-out;
  z-index: 1;
  overflow: hidden;
}


.not-approved .approve-toggle-btn{
  background-color: rgb(34, 158, 230);
  box-shadow: rgb(18, 95, 121) 0px 4px 0px 0px;
}

.approve-toggle-btn::before {
  content: "";
  width: 0;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: -1;
  transition: width 700ms ease-in-out;
  display: inline-block;
}

.not-approved .approve-toggle-btn::before{
    background-color: rgb(50, 156, 248);

}


.approve-toggle-btn:hover::before {
  width: 100%;
}
</style>
