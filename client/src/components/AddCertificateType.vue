<template>
  <div class="d-flex align-items-center gap-3">
    <div>
      <input
        v-model="newCertificateType"
        placeholder="New certificate Type"
        class="input-certificate"
        type="text"
      />
    </div>
    <div>
      <button @click="addNewCertificateType" class="submit">New</button>
    </div>
  </div>
</template>

<script>
import {useAxios} from '../API/queries';
import { successNotification } from './notification/ToastNotification';

export default {
  name: "AddCertificateType",
  data() {
    return {
      newCertificateType: "" ,
      certificates:[]
    };
  },
  methods: {
      async addNewCertificateType() {
        const {addNewCertificateTypeAPI}=useAxios()
        try {
          const response = await addNewCertificateTypeAPI(this.newCertificateType)
          const newCertificate = await response.data;
          successNotification("Completed !")
          this.$emit('certificateAdded', newCertificate.data);
          this.newCertificateType = '';
        } catch (error) {
        console.error(error);
        }
    },
  }
};
</script>

<style>
.input-certificate {
 border: none;
 padding: 8px;
 border-radius: 5px;
 background: #e8e8e8;
 transition: 0.3s;
}

.input-certificate:focus {
 outline-color: #e8e8e8;
 box-shadow: inset 20px 20px 60px #c5c5c5;
 transition: 0.3s;
}
</style>
