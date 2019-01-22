/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import ChecksPrivileges from './services/ChecksPrivileges'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VueSelect from 'vue-select'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


/*const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));*/

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('v-select', VueSelect);

Vue.component('modal', {}.default);

Vue.use(ChecksPrivileges);
//Career Notes
Vue.component('career-notes', require('./components/career/CareerNotes'));
Vue.component('career-note', require('./components/career/CareerNote'));
//End career Notes
//Project
Vue.component('project-view', require('./components/project/ProjectView'));
//End Project

Vue.component('user-career', require('./components/career/CareerComponent'));
Vue.component('user-list', require('./components/user/UsersListComponent.vue'));
Vue.component('user-list-view', require('./components/user/UserListViewComponent'));
Vue.component('profile-view', require('./components/user/ProfileView'));
Vue.component('profile-avatar', require('./components/user/ProfileAvatarComponent'));
Vue.component('file-upload', require('./components/FileUpload.vue'));
Vue.component('department-list', require('./components/department/DepartmentListComponent.vue'));
Vue.component('department-list-view', require('./components/department/DepartmentListView.vue'));
Vue.component('team-list', require('./components/team/TeamListComponent.vue'));
Vue.component('team-list-view', require('./components/team/TeamListView.vue'));
Vue.component('user-development', require('./components/user/UserDevelopmentComponent.vue'));
Vue.component('user-department', require('./components/user/UserDepartmentComponent.vue'));
Vue.component('user-team', require('./components/user/UserTeamComponent'));
Vue.component('user-hobbies', require('./components/user/UserHobby'));
Vue.component('user-children', require('./components/user/UserChild'));
Vue.component('user-role', require('./components/user/UserRole'));
Vue.component('add-career', require('./components/career/AddCareer'));
Vue.component('user-description', require('./components/career/DescriptionComponent'));
Vue.component('user-strenght', require('./components/user/UserStrenght'));
Vue.component('user-training', require('./components/user/UserTraining'));
Vue.component('user-project', require('./components/user/UserProject'));
Vue.component('user-skill', require('./components/user/UserSkill'));
Vue.component('user-badge', require('./components/user/UserBadge'));
Vue.component('career-role', require('./components/career/CareerRole'));
Vue.component('editable-input-component', require('./components/EditableInputComponent'));
Vue.component('user-career-milestone', require('./components/career/CareerMilestone'));
Vue.component('user-team-moderator', require('./components/admin/UserTeamModerator'));
Vue.component('admin-career-template-manager', require('./components/admin/Career/CareerTemplateManager'));
Vue.component('milestone-form', require('./components/career/CareerMilestoneForm'));
Vue.component('users-list-head', require('./components/admin/UsersListHead'));
Vue.component('users-list-body', require('./components/admin/UsersListBody'));
Vue.component('career-role-form', require('./components/career/AddUserCareerRole'));
Vue.component('user-child-form', require('./components/user/UserChildrenForm'));
Vue.component('user-hobby-form', require('./components/user/UserHobbyForm'));
Vue.component('admin-view-strength-category', require('./components/category/MainView'));
Vue.component('strength-category-view', require('./components/category/StrengthCategoryView'));
Vue.component('strength-component', require('./components/category/StrengthCategoryComponent'));
Vue.component('category-view', require('./components/category/CategoryView'));
Vue.component('category-component', require('./components/category/CategoryComponent'));

Vue.component('admin-view-team', require('./components/admin/team/TeamView'));
Vue.component('admin-view-department', require('./components/admin/department/DepartmentView'));
Vue.component('admin-department-body', require('./components/admin/department/DepartmentBody'));
Vue.component('admin-team-body', require('./components/admin/team/TeamBody'));

Vue.component('admin-view-user-strength', require('./components/UserStrengthView'));
Vue.component('admin-user-strength', require('./components/UserStrengthComponent'));
Vue.component('admin-view-team-moderator', require('./components/admin/team/TeamModeratorView'));
Vue.component('department-user-strength-category', require('./components/UsersStrengthView/MainView'));
Vue.component('modal', require('./components/Modal/modal'));
Vue.component('search', require('./components/search/SearchComponent'));

const app = new Vue({
    el: '#app',
});

