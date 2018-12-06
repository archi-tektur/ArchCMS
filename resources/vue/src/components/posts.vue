<template>
    <section>
        <h2>Posts</h2>
        <article v-for="item in posts" :key="item.id">
            <a :href="item.url" v-text="item.title"></a>
            <span v-text="item.time" />
        </article>
    </section>
</template>

<script>
import axios from 'axios'
import qs from 'qs'

export default {
    name: 'posts',
    data(){
        return{
            posts: {operation: "loading"},
            postData: {operation: 'get'}
        }
    },
    mounted(){
        axios
          .post("api/cms", qs.stringify({data: this.postData}))
          .then(response => {this.posts = JSON.parse( response.data.slice(0, response.data.lastIndexOf("1")) )})
          .catch(error => console.log(error))

    }
}
</script>
