import { createWebHistory, createRouter } from "vue-router";

import Users from '../Pages/Users/Users.vue';
import Add_User from '../Pages/Users/Add_User.vue';
import Edit_User from '../Pages/Users/Edit_User.vue';
import Customers from '../Pages/Customers.vue';
import Login from '../Pages/Login.vue';
import All_Booking from '../Pages/Booking/All_Booking.vue';
import Rooms from '../Pages/Rooms/Rooms.vue';
import RoomType from '../Pages/Rooms/RoomType.vue';
import checkin from '../Pages/Check-in-out/check-in.vue';
import checkout from '../Pages/Check-in-out/check-out.vue';
import Payment from '../Pages/Check-in-out/Payment.vue';
import Expenses from '../Pages/Expenses.vue';
import Report from '../Pages/Report/Dashboard.vue';
import history from '../Pages/Home/history.vue'
import data from '../Pages/Home/data.vue'
import Notification from '../Pages/Home/Notification.vue'
import Home from '../Pages/Home/Home.vue'; // Assuming you have a NoPage component// Assuming Rent.vue is your main component
import cin from '../Pages/Report/Report.vue';
import Repay from '../Pages/Report/Repay.vue'
import pay from '../Pages/Report/pay.vue'

import { useStore } from "../store/auth";

const authMiddleware = (to, from, next) => {
    const token = localStorage.getItem('web_token');
    const user = localStorage.getItem('web_user');
    const store = useStore();

    if (!token) {
        next({
            path: '/Login',
            replace: true
        });
    } else {
        store.set_token(token);
        store.set_user(user);
        next();
    }
};

export const routes = [
    {
        path: '/',
        redirect: '/Login'
    },
    {
        name: 'Customers',
        path: '/Customers',
        component: Customers,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'Repay',
        path: '/Repay',
        component: Repay,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'pay',
        path: '/pay',
        component: pay,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'Users',
        path: '/Users',
        component: Users,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'Add_User',
        path: '/Add_User',
        component: Add_User,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'Edit_User',
        path: '/Edit_User/:id',
        component: Edit_User,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'Rooms',
        path: '/Rooms',
        component: Rooms,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'RoomType',
        path: '/RoomType',
        component: RoomType,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'Login',
        path: '/Login',
        component: Login
    },
    {
        name: 'All_Booking',
        path: '/All_Booking',
        component: All_Booking,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'checkin',
        path: '/checkin',
        component: checkin,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'checkout',
        path: '/checkout',
        component: checkout,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'Notification',
        path: '/Notification',
        component: Notification,
    //     meta: {
    //         middleware: [authMiddleware]
    //     }
    },
    {
        name: 'data',
        path: '/data',
        component: data,
    //     meta: {
    //         middleware: [authMiddleware]
    //     }
    },
    {
        name: 'history',
        path: '/history',
        component: history,
    //     meta: {
    //         middleware: [authMiddleware]
    //     }
    },
    {
        name: 'Payment',
        path: '/Payment',
        component: Payment,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'Expenses',
        path: '/Expenses',
        component: Expenses,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'Report',
        path: '/Report',
        component: Report,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: 'in',
        path: '/cin',
        component: cin,
        meta: {
            middleware: [authMiddleware]
        }
    },
    {
        name: '',
        path: '/:pathMatch(.*)*',
        component: Home,
        // meta: {
        //     middleware: [authMiddleware]
        // }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
    scrollBehavior() {
        window.scrollTo(0, 0);
    }
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('web_token');
    
    if (to.meta.middleware) {
        const middlewareArray = to.meta.middleware;
        middlewareArray.forEach(middleware => middleware(to, from, next));
    } else {
        if (to.path === '/Login' || to.path === '/') {
            if (token) {
                next({
                    path: '/Home',
                    replace: true
                });
            } else {
                next();
            }
        } else {
            next();
        }
    }
});

export default router;
