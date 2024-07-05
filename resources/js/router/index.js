import { createWebHistory, createRouter } from "vue-router";

import Home from  '../Pages/Home.vue';
import Users from '../Pages/Users/Users.vue';
import Customers from '../Pages/Customers/Customers.vue';
import Login from  '../Pages/Login.vue';
import Booking from  '../Pages/Booking.vue';
import Rooms from  '../Pages/Rooms.vue';
import Moveinout from  '../Pages/Movein-out.vue';
import Payment from  '../Pages/Payment.vue';
import Nofitication from  '../Pages/Notification.vue';
import Register from  '../Pages/Register.vue';
import Report from  '../Pages/Report.vue';
import Customers_add from "../Pages/Customers/Customers_add.vue";

export const routes = [
    {


    },
    {
        name: 'Home',
        path: '/Home',
        component: Home

    },
    {
        name: 'Customers',
        path: '/Customers',
        component: Customers

    },
    {
        name: 'Customers_add',
        path: '/Customers_add',
        component: Customers_add

    },
    {
        name: 'Users',
        path: '/Users',
        component: Users

    },
    {
        name: 'Rooms',
        path: '/Rooms',
        component: Rooms

    },
    {
        name: 'Login',
        path: '/Login',
        component: Login

    },
    {
        name: 'Booking',
        path: '/Booking',
        component: Booking

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