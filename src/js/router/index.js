import Vue from 'vue'
import VueRouter from 'vue-router'
import App from '../views/App.vue'
import Blog from '../components/Blog/Front/Blog.vue'
import Home from '../components/Home/Home.vue'

Vue.use(VueRouter)
export default new VueRouter({
  mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/blog',
            name: 'blog',
            component: Blog
        },

        {
            path: '/admin',
            name: 'admin',
            component: Home
        },

    ],
});