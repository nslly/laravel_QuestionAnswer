import './bootstrap';

import { createApp } from 'vue';

import policies from './authorization/policies';
import QuestionPage from './pages/QuestionPage.vue'

import mitt from 'mitt';                  // Import mitt
const emitter = mitt();                   // Initialize mitt

const app = createApp({})

    app.component('QuestionPage', QuestionPage);

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
