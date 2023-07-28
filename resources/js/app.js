import './bootstrap';

import { createApp } from 'vue';
import Index from './components/Index.vue';
import UserInfo from './components/UserInfo.vue';

const app = createApp({})
    app.component('Index', Index);
    app.component('UserInfo', UserInfo);
    app.mount('#app');
