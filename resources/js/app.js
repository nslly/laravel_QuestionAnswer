import './bootstrap';

import { createApp } from 'vue';
import Index from './components/Index.vue';
import UserInfo from './components/UserInfo.vue';
import Answer from './components/Answer.vue';
import Favorite from './components/Favorite.vue';
import Accept from './components/Accept.vue';
import policies from './authorization/policies';

const app = createApp({})
    app.component('UserInfo', UserInfo);
    app.component('Answer', Answer);
    app.component('Favorite', Favorite);
    app.component('Accept', Accept);

    // Using provide methods
    app.provide('authorize', function (policy,model) {
        if( !window.Auth.signedIn) return false;

        if(typeof policy === "string" && typeof model === 'object') {
            const user = window.Auth.user;

            return policies[policy](user,model);
        }
    });

    app.mount('#app');
