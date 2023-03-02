import {createApp} from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './components/App.vue';
import {routes} from './routes';
import axios from 'axios';

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

createApp(App).use(router, axios).mount('#app')



// import './bootstrap';
// import vue from 'vue';
// window.Vue = vue;

// import App from './components/App.vue';
// import VueRouter from 'vue-router';
// import VueAxios from 'vue-axios';
// import axios from 'axios';
// import {routes} from './routes';

// Vue.use(VueRouter);
// Vue.use(VueAxios, axios);

// const router = new VueRouter({
//     mode: 'history',
//     routes: routes
// });

// const app = new Vue({
//     el: '#app',
//     router: router,
//     render: h => h(App),
// })