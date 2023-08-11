<template>
    <div>registration component!</div>
    <div>
        <input v-model="name" class="form-control" type="text" placeholder="name">
        <br>
        <input v-model="email" class="form-control" type="text" placeholder="email">
        <br>
        <input v-model="password" class="form-control" type="password" placeholder="password">
        <br>
        <input v-model="password_confirmation" class="form-control" type="password" placeholder="password_confirmation">
        <br>
        <input @click.prevent="registration" value="register" class="btn btn-primary" type="submit">
    </div>
</template>

<script>
export default {
    name: "Registration",

    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null
        }
    },

    methods: {
        registration() {
            console.log(this.name,this.email, this.password,this.password_confirmation)
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                    .then(res=>{
                        // console.log(res)
                        localStorage.setItem('x_xsrf_token', res.config.headers['X-XSRF-TOKEN'])
                        this.$router.push({name: 'user.personal'})
                    })
                    .catch(err=>{
                        // console.log(err.response)
                    })

            });
        }
    }

}
</script>

<style scoped>

</style>