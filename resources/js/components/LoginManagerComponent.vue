<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manager Login</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" required autocomplete="email" autofocus v-model="form.email">
                            <span class="invalid-feedback d-inline" role="alert" v-if="this.errors.email">
                                <strong>{{ this.errors.email[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password" required autocomplete="current-password" v-model="form.password">
                            <span class="invalid-feedback d-inline" role="alert" v-if="this.errors.password">
                                <strong>{{ this.errors.password[0] }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button class="btn btn-primary" @click.prevent="login">
                                Login
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return {
            form:{
                password:'',
                email:'',
            },
            errors: []
        }
    },
    methods:{
        login(){
            axios.post('/api/managers/login', this.form).then(response => {
                  location.reload();
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                })
        }
    }
}
</script>
