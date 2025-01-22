import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

import App from './vue/App.vue';
import Home from './vue/components/Home.vue';
import AddProduct from './vue/components/AddProduct.vue';
import AddDiscount from './vue/components/AddDiscount.vue';
import Product from './vue/components/Product.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/add-product', component: AddProduct },
    { path: '/add-discount', component: AddDiscount },
    { path: '/product/:id', component: Product },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

createApp(App).use(router).mount('#app');
