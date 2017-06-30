/**
 * Add the CSRF Token to the Laravel object. The Laravel object is being 
 * used by Axios and the reference can be seen in ./bootstrap.js
 * 
 * Requires the token be set as a meta tag as described in the documentation:
 * https://laravel.com/docs/5.4/csrf#csrf-x-csrf-token
 */

window.Laravel = { csrfToken: document.head.querySelector("[name=csrf-token]").content }

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component(
    'passportclients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passportauthorizedclients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passportpersonalaccesstokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

const app = new Vue({
    el: '#app'
});

