import { createRouter, createWebHistory } from 'vue-router';
import List from '../Pages/List.vue';
import Create from '../Pages/Create.vue';
import Ad from '../Pages/Ad.vue';

const routes = [
    {
        path: '/',
        name: 'List',
        component: List
    },
    {
        path: '/add',
        name: 'Create',
        component: Create
    },
    {
        path: '/show/:id',
        name: 'Ad',
        component: Ad,
        props: true
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
