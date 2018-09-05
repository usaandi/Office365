
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
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(ChecksPrivileges);
Vue.component('user-list', require('./components/user/UsersListComponent.vue'));
Vue.component('user-list-view', require('./components/user/UserListViewComponent'));
Vue.component('profile-view', require('./components/user/ProfileView'));
Vue.component('profile-avatar', require('./components/user/ProfileAvatarComponent'));
Vue.component('file-upload',require('./components/FileUpload.vue'));
Vue.component('department-list',require('./components/department/DepartmentListComponent.vue'));
Vue.component('department-list-view',require('./components/department/DepartmentListView.vue'));
Vue.component('team-list',require('./components/team/TeamListComponent.vue'));
Vue.component('team-list-view',require('./components/team/TeamListView.vue'));
Vue.component('user-development',require('./components/user/UserDevelopmentComponent.vue'));
Vue.component('user-department',require('./components/user/UserDepartmentComponent.vue'));
Vue.component('user-team',require('./components/user/UserTeamComponent'));
Vue.component('user-hobbies',require('./components/user/UserHobby'));
Vue.component('user-children',require('./components/user/UserChild'));
Vue.component('user-role', require('./components/user/UserRole'));
Vue.component('add-career', require('./components/career/AddCareer'));
Vue.component('user-career', require('./components/career/CareerComponent'));
Vue.component('user-description', require('./components/career/DescriptionComponent'));
Vue.component('milestone-add', require('./components/career/MilestoneAdd'));
Vue.component('user-milestone', require('./components/career/MilestoneComponent'));
Vue.component('user-title', require('./components/career/TitleComponent'));
Vue.component('user-strenght', require('./components/user/UserStrenght'));
Vue.component('user-training', require('./components/user/UserTraining'));
Vue.component('user-project', require('./components/user/UserProject'));
Vue.component('user-skill', require('./components/user/UserSkill'));
Vue.component('user-badge', require('./components/user/UserBadge'));
Vue.component('editable-input-component', require('./components/EditableInputComponent'));
Vue.component('v-select', VueSelect.VueSelect);

const app = new Vue({
    el: '#app',
});
