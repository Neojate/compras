import Vue from 'vue';
import VueRouter from 'vue-router';

import App from './views/App.vue';
import Home from './views/home/Home.vue';
import Listas from './views/listas/Listas.vue';
import Lista from './views/listas/Lista.vue';


Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/listas',
            name: 'listas',
            component: Listas
        },
        {
            path: '/lista/:id',
            name: 'lista',
            component: Lista
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router
});
