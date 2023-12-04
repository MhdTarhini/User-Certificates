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
      <button @click="addNewCertificateType" class="primary-btn new-type-btn">New</button>
    </div>
  </div>
</template>

<script>
import {useAxios} from '../API/queries';

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
 background: #e8e8e8;
 box-shadow: inset 20px 20px 60px #c5c5c5,
		inset -20px -20px 60px #ffffff;
 transition: 0.3s;
}
.new-type-btn{
  border-radius: 5px;
  background-color: rgb(73, 230, 34);
  box-shadow: rgb(27, 68, 5) 0px 4px 0px 0px;
}

.new-type-btn::before{
    background-color: rgb(46, 255, 77);
}

</style>
