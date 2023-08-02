import './bootstrap';

import { createApp } from 'vue';
import Index from './components/Index.vue';
import UserInfo from './components/UserInfo.vue';
import Answer from './components/Answer.vue';
import Favorite from './components/Favorite.vue';

const app = createApp({})
    app.component('UserInfo', UserInfo);
    app.component('Answer', Answer);
    app.component('Favorite', Favorite);
    app.mount('#app');
