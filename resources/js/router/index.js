import { createWebHistory, createRouter } from "vue-router";

import Home from  '../Pages/Home.vue';
import Users from '../Pages/Users/Users.vue';
import Add_User from '../Pages/Users/Add_User.vue';
import Edit_User from '../Pages/Users/Edit_User.vue';
import Customers from '../Pages/Customers.vue';
import Login from  '../Pages/Login.vue';
import Add_Booking from  '../Pages/Booking/Add_Booking.vue';
import All_Booking from  '../Pages/Booking/All_Booking.vue';
import Edit_Booking from  '../Pages/Booking/Edit_Booking.vue';
import Rooms from  '../Pages/Rooms/Rooms.vue';
import RoomType from  '../Pages/Rooms/RoomType.vue';
import checkin from  '../Pages/Check-in-out/check-in.vue';
import checkout from  '../Pages/Check-in-out/check-out.vue';
import Payment from  '../Pages/Payment.vue';
import Expenses from  '../Pages/Expenses.vue';
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
        name: 'Customers',
        path: '/Customers',
        component: Customers

    },
    {
        name: 'Users',
        path: '/Users',
        component: Users

    },
    {
        name: 'Add_User',
        path: '/Add_User',
        component: Add_User

    },
    {
        name: 'Edit_User',
        path: '/Edit_User/:id',
        component: Edit_User

    },
    {
        name: 'Rooms',
        path: '/Rooms',
        component: Rooms

    },
    {
        name: 'RoomType',
        path: '/RoomType',
        component: RoomType

    },
    {
        name: 'Login',
        path: '/Login',
        component: Login

    },
    {
        name: 'Add_Booking',
        path: '/Add_Booking',
        component: Add_Booking

    },
    {
        name: 'All_Booking',
        path: '/All_Booking',
        component: All_Booking

    },
    {
        name: 'Edit_Booking',
        path: '/Edit_Booking',
        component: Edit_Booking

    },
    {
        name: 'checkin',
        path: '/checkin',
        component: checkin

    },
    {
        name: 'checkout',
        path: '/checkout',
        component: checkout

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
        name: 'Expenses',
        path: '/Expenses',
        component: Expenses

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