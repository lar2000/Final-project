import { createWebHistory, createRouter } from "vue-router";

import Home from  '../Pages/Home.vue';
import Login from  '../Pages/Login.vue';
import Markroom from  '../Pages/Markroom.vue';
import Moveinout from  '../Pages/Movein-out.vue';
import Payment from  '../Pages/Payment.vue';
import Nofitication from  '../Pages/Notification.vue';
import Register from  '../Pages/Register.vue';
import Report from  '../Pages/Report.vue';

export const routes = [
    {


    },
    {
        name: 'Home',
        path: '/Home',
        component: Home

    },
    {
        name: 'Login',
        path: '/Login',
        component: Login

    },
    {
        name: 'Markroom',
        path: '/Markroom',
        component: Markroom

    },
    {
        name: 'Movein-out',
        path: '/Movein-out',
        component: Moveinout

    },
    {
        name: 'Notification',
        path: '/Notification',
        component: Nofitication

    },
    {
        name: 'Payment',
        path: '/Payment',
        component: Payment

    },
    {
        name: 'Register',
        path: '/Register',
        component: Register

    },
    {
        name: 'Report',
        path: '/Report',
        component: Report

    },
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
    scrollBehavior(){
        window.scrollTo(0,0)
    }
});

export default router;