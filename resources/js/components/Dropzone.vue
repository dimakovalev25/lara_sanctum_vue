<template>
    <div>dropzone component!</div>
    <input v-model="title" type="text" placeholder="title post dropzone!!!">
    <br> <br>
    <div class="dropzone" ref="dropzone">
        Upload
    </div>
    <br>
    <input @click.prevent="store" value="add" type="submit">
</template>

<script>
import {Dropzone} from "dropzone";

export default {
    name: "Dropzone",

    data() {
        return {
            dropzone: null,
            title: null
        }
    },

    mounted() {
        this.dropzone = new Dropzone(this.$refs.dropzone, {
            url: 'test',
            autoProcessQueue: false
        })
    },
    methods: {
        store() {
            let data = new FormData();
            let data2 = data;
            let imgs = this.dropzone.getAcceptedFiles();

            imgs.forEach(item => {
                data2.append('images[]', item)
            })


            axios.post('/api/posts', data2)
                .then(res => {
                    console.log(res.response.data)
                })
            // console.log(this.dropzone.getAcceptedFiles());
        }

    }


}
</script>

<style scoped>
.dropzone {
    padding: 5px;
    width: 50%;
    /*height: 10rem;*/
    background-color: gray;
    text-decoration-color: #f8fafc;
    text-align: center;

}
</style>