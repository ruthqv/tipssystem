import Vue from 'vue'
import VueRouter from 'vue-router'
import App from '../views/App.vue'
import Home from '../views/Home.vue'
import Tip from '../views/Tip.vue'

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
            path: '/tip/:id',
            name: 'singletip',
            component: Tip,
            props: true 
        },




    ],
});