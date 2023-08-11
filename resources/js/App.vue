<template>

      <div id="app" class="container">
          <router-link v-if="token" :to="{name: 'get'}">get |</router-link>
          <router-link v-if="token" :to="{name: 'posts'}">posts |</router-link>
          <router-link v-if="!token" :to="{name: 'user.login'}">login |</router-link>
          <router-link v-if="!token" :to="{name: 'user.registration'}">registration |</router-link>
          <router-link v-if="token" :to="{name: 'user.personal'}">personal |</router-link>
          <a v-if="token" @click.prevent="logout" href="">logout |</a>
          <br>
          <br>
<!--          <router-view></router-view>-->
          <router-view :key="$route.fullPath" ></router-view>
<!--          <Index></Index>-->
      </div>

<!--    <div id="app" class="container" :key="componentKey" >
            <router-link :to="{name: 'get'}">get |</router-link>
            <router-link :to="{name: 'user.personal'}">personal |</router-link>
            <a @click.prevent="logout" href="">logout |</a>
            <router-link :to="{name: 'user.login'}">login |</router-link>
            <router-link :to="{name: 'user.registration'}">registration |</router-link>
        <br>
        <router-view></router-view>
        <Index></Index>
    </div>-->
</template>

<script>

import Index from "@/components/Index.vue";

export default {
    components: {
        Index

    },

    data() {
        return {
            token: null,
        }
    },

    mounted() {
        this.getToken()
    },


    updated() {
        this.getToken()
        // console.log('updated get token')
    },



    methods: {
        logout() {
            axios.post('/logout')
                .then(res => {
                    localStorage.removeItem('x_xsrf_token')
                    this.$router.push({name: 'user.login'})
                    // console.log(res)
                    // console.log(' delete token')
                })
        },

        getToken() {
            this.token = localStorage.getItem('x_xsrf_token')
            // console.log('get token')
        },

    }

}

</script>
