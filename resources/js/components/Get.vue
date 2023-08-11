<template>
<div>get component!</div>
</template>

<script>
export default {
    name: "Get",

    mounted() {
      this.getdata()
    },

    methods: {
        getdata(){
            axios.get('api/get')
                .then(res=>{
                    // console.log(res)
                })
        }
    }



}
</script>

<style scoped>

</style>