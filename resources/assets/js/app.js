
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
import ChecksPrivileges from './services/ChecksPrivileges'
Vue.use(ChecksPrivileges);

Vue.component('user-list', require('./components/UsersListComponent.vue'));
Vue.component('user-list-view', require('./components/UserListViewComponent'));
Vue.component('profile-view', require('./components/ProfileView'));
Vue.component('profile-avatar', require('./components/ProfileAvatarComponent'));
Vue.component('file-upload',require('./components/FileUpload.vue'));

const app = new Vue({
    el: '#app'
});
