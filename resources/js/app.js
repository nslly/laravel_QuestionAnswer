import './bootstrap';

import { createApp } from 'vue';
import Index from './components/Index.vue';
import UserInfo from './components/UserInfo.vue';
import Vote from './components/Vote.vue';
import Answers from './components/Answers.vue';
import policies from './authorization/policies';

import mitt from 'mitt';                  // Import mitt
const emitter = mitt();                   // Initialize mitt

const app = createApp({})
    app.component('UserInfo', UserInfo);
    app.component('Vote', Vote);
    app.component('Answers', Answers);

    app.config.globalProperties.emitter = emitter; // using global property to use $this.emitter
    
    // Using provide methods
    app.provide('authorize', function (policy,model) {
        if( !window.Auth.signedIn) return false;

        if(typeof policy === "string" && typeof model === 'object') {
            const user = window.Auth.user;

            return policies[policy](user,model);
        }
    });

    app.mount('#app');
