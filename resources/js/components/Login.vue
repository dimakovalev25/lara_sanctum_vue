<template>
    <div>login component!</div>
    <div>
        <input v-model="email" class="form-control" type="text" placeholder="email">
        <br>
        <input v-model="password" class="form-control" type="text" placeholder="password">
        <br>
        <input @click.prevent="login" class="btn btn-primary" type="submit">
        <br>

    </div>
</template>

<script>
export default {
    name: "Login",

    data() {
        return {
            email: '',
            password: ''
        }
    },

    methods: {
        login() {
            // console.log(this.email, this.password)

            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {email: this.email, password: this.password})
                    .then(res => {
                        localStorage.setItem('x_xsrf_token', res.config.headers['X-XSRF-TOKEN'])
                        this.$router.push({name: 'user.personal'})
                    })
                    .catch(err => console.log(err.response))

            });
        }
    }
}
</script>

<style scoped>

</style>