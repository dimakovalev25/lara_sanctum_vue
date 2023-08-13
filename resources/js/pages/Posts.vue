<template>
    <div>
        <h1>posts</h1>
    </div>
    <div class="w-25">
        <input v-model="title" type="text" class="form-control inp" placeholder="title!!!">

        <div class="dz" ref="dropzone">upload img</div>
        <button @click.prevent="store" class="btn btn-success" type="submit">add</button>
    </div>

    <div v-if="post" class="mt-5">
        <div>
            <h4>{{post.title}}</h4>
            <div v-for="image in post.images" class="mb-3">
                <img  :src="image.url" class="mb-3">
                <img  :src="image.preview_url" >
            </div>
        </div>
    </div>
</template>
<script>
import {Dropzone} from "dropzone";

export default {
    name: "home",
    components: {},

    data() {
        return {
            dropzone: null,
            title: null,
            post: null
        }
    },

    mounted() {
        this.dropzone = new Dropzone(this.$refs.dropzone, {
            url: 'af',
            autoProcessQueue: false,
            addRemoveLinks: true
        })
        this.getPost()

    },

    methods: {

        store() {
            let data = new FormData();
            let imgs = this.dropzone.getAcceptedFiles();

            imgs.forEach(item => {
                data.append('images[]', item)
                this.dropzone.removeFile(item);
            })
            data.append('title', this.title)
            this.title = '';
            axios.post('/api/posts', data)
                .then(res => {
                    console.log(res.response.data)
                    this.getPost()
                })
        },

        getPost() {
            axios.get('/api/posts')
                .then(res => {
                    this.post = res.data.data
                    console.log(this.posts)
                })
                .catch(res => {
                    console.log(res.response.data)
                })
        }
    }

}

</script>

<style>

.dz {
    width: 10rem;
    padding: 5px;
    background: #2c3034;
    text-align: center;
    color: white;
    border: 5px;
    margin: 10px 10px 10px 0px;
}

.inp {
    margin-top: 10px;
}
</style>