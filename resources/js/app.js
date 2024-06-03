import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import Menu from './Components/MenuSidebar.vue';
import router from './router/index.js';

//ເອີ້ນໃຊ້
const app = createApp(App)
app.use(router)
app.component('MenuSidebar',Menu)
app.mount('#app-vue');