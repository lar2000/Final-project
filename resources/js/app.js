import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import Menu from './Components/MenuSidebar.vue';
import router from './router/index.js';
import axios from 'axios';


import { createPinia } from 'pinia';
const pinia = createPinia();

//ເອີ້ນໃຊ້
const app = createApp(App)
app.use(router)
app.use(pinia)
app.component('MenuSidebar',Menu)
app.mount('#app-vue');

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';