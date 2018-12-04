import Vue from 'vue'
import Router from 'vue-router'
import start from '../components/start'
import info from '../components/info'
import posts from '../components/posts'

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'start',
            component: start
        },
        {
            path: '/info',
            name: 'info',
            component: info
        },
        {
            path: '/posts',
            name: 'posts',
            component: posts
        },
    ]
})