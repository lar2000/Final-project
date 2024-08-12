import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import Menu from './Components/MenuSidebar.vue';
import router from './router/index.js';
import axios from 'axios';
import jsPDF from 'jspdf';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import checkOut from './Pages/Check-in-out/check-out.vue';

import { createPinia } from 'pinia';
const pinia = createPinia();

//ເອີ້ນໃຊ້
const app = createApp(App)
app.use(router)
app.use(pinia)
app.use(jsPDF)
app.component('MenuSidebar',Menu)
app.mount('#app-vue');
use(VueSweetalert2);
app.component('checkout-added', checkOut);

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';