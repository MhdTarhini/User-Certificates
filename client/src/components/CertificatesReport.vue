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
        <td>{{ certificate.user_certificates_count }}</td>
        
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
    props: {
    certificates: {
      type: Array,
      required: true
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
