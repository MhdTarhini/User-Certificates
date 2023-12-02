<template>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Members</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="certificate in certificates" :key="certificate.id">
        <td>{{ certificate.id }}</td>
        <td>{{ certificate.name }}</td>
        <td>{{ certificate.email }}</td>
        
      </tr>
    </tbody>
  </table>
</template>

<script>
import { useAxios } from '../API/queries';

export default {
  data() {
    return {
      certificates: [],
    };
  },
  async created() {
    const {getCertificatesReportAPI}=useAxios()
    try {
        const response = await getCertificatesReportAPI()
        const certificatesReport=await response.data
        this.certificates = certificatesReport.data
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
