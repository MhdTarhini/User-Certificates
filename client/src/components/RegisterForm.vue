<template>
    <div class="row justify-content-md-center mt-5">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Register</h5>
                    <form>
                        <div class="mb-3">
                            <label htmlFor="name" class="form-label">Name
                            </label>
                            <input type="text" class="form-control" id="name" name="name" v-model="name" />
                            <div v-if="validationErrors.name" class="flex flex-col">
                                <small class="text-danger">
                                    {{ validationErrors?.name[0] }}
                                </small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label htmlFor="email" class="form-label">Email address
                            </label>
                            <input type="email" class="form-control" id="email" name="email" v-model="email" />
                            <div v-if="validationErrors.email" class="flex flex-col">
                                <small class="text-danger">
                                    {{ validationErrors?.email[0] }}
                                </small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label htmlFor="password" class="form-label">Password
                            </label>
                            <input type="password" class="form-control" id="password" name="password" v-model="password" />
                            <div v-if="validationErrors.password" class="flex flex-col">
                                <small class="text-danger">
                                    {{ validationErrors?.password[0] }}
                                </small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="bloodType" class="form-label">Blood Type</label>
                            <select v-model="bloodType" class="form-select" id="bloodType" name="bloodType">
                                <option value="">Select Blood Type</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B+">O+</option>
                                <option value="B+">O-</option>
                            </select>
                            <div v-if="validationErrors.password" class="flex flex-col">
                                <small class="text-danger">
                                    {{ validationErrors?.bloodType[0] }}
                                </small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select v-model="gender" class="form-select" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div v-if="validationErrors.password" class="flex flex-col">
                                    <small class="text-danger">
                                        {{ validationErrors?.gender[0] }}
                                    </small>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button :disabled="isSubmitting" @click="registerAction()" type="button"
                                class="btn btn-primary btn-block">Register Now
                            </button>
                            <p class="text-center">Have already an account <router-link to="/">Login here</router-link></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import { useAxios } from '../API/queries';

export default {
    name: 'RegisterForm',
    data() {
        return {
            name: '',
            email: '',
            password: '',
            bloodType:   '',
            gender:   '',
            validationErrors: {},
            isSubmitting: false,
        };
    },
    methods: {
        async registerAction() {
            this.isSubmitting = true
            let userInfo = {
                name: this.name,
                email: this.email,
                password: this.password,
                bloodType: this.bloodType,
                gender: this.gender,
            }
            const { registerAPI } = useAxios();
            console.log(userInfo)

            try {
                const response = await registerAPI(userInfo)
                const RegisterUser=await response.data
                if(RegisterUser.status==="success"){
                    this.$router.push('/login')
                }
            } catch (error) {
                this.isSubmitting = false
                if (error.response.data.errors != undefined) {
                    this.validationErrors = error.response.data.errors
                }
            }
        }
    },
};
</script>