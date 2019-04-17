<template>
    <div>
        <modal v-if="show"
        >
            <h3 slot="header">
                Delete User
            </h3>

            <div slot="body">
                <p class="text-center alert alert-danger">
                    Are you sure you want to delete User: {{userObject.name}}?
                </p>
                <p class="">
                    For confirmation TYPE below: YES
                </p>
                <input style="outline: none"
                       :class="{'border-danger': this.confirmationText!=='YES', 'border-success':this.confirmationText==='YES'}"
                       class="border " type="text" v-model="confirmationText">
            </div>
            <div slot="footer">
                <button type="button" class="btn btn-success" @click="cancelDeletion">Cancel</button>
                <button type="submit" class="btn btn-danger" @click="confirmDeletion(userObject.id)">Delete</button>
            </div>
        </modal>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row m--margin-bottom-15">
                    <div class="col-sm-3 col-xs-12"></div>
                    <div class="col-sm-9 col-xs-12">
                        <div class="profile-timeline__action ">
                            <a :href="'admin/users/add'" class="btn btn-success m-btn m-btn--icon m-btn--pill">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>Add User</span>
                                    </span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>

            <div class="table-responsive">
                <span class="float-left m--margin-bottom-5"></span>
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr is="users-list-body" v-for="(user, index) in users"
                        :propUser="user"
                        :key="index"
                        :index="index"
                        @deleteUser="deleteUser($event)"
                    >
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "UsersList",
        data() {
            return {
                users: '',
                show: false,
                userObject: {},
                confirmationText: '',
                userObjectIndex: ''
            }
        },
        mounted() {
            this.getUsers();
        },
        methods: {

            cancelDeletion() {
                this.userObject = null;
                this.confirmationText = null;
                this.show = false;
                this.userObjectIndex = null;

            },

            confirmDeletion(userId) {
                if (this.confirmationText === 'YES') {

                    let data = {
                        userId: userId
                    };

                    let vm = this;
                    axios.delete('admin/user/delete', {params: data})
                        .then(function (response) {
                            if (response.status === 200) {
                                vm.users.splice(vm.userObjectIndex, 1);
                                vm.userObject = null;
                                vm.confirmationText = null;
                                vm.show = false;
                                vm.userObjectIndex = null;
                                data = null;
                            }
                        });


                }
                else {

                }

            },

            getUsers() {
                axios.get('users').then(response => {
                    this.users = response.data;
                })
            },
            deleteUser(objectIndex) {

                this.userObject = this.users[objectIndex];
                this.userObjectIndex = objectIndex;
                this.show = true;


                axios.delete('admin/user/delete', {params: data})
                    .then(function (response) {
                        if (response.status === 200) {
                            this.users.splice(objectIndex, 1);
                        }
                    });
            }
        }
    }
</script>

<style scoped>

</style>