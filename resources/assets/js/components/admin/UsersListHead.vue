<template>
    <div>
        <div class="table-responsive">
            <span class="float-left m--margin-bottom-5"></span>
            <table class="table table-bordered text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                <tr is="users-list-body" v-for="(user, index) in users"
                :propUser="user"
                :key="index"
                >
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "UsersList",
        data(){
            return{
                users:''
            }
        },
        mounted(){
            this.getUsers();
        },
        methods:{
            getUsers(){
                axios.get('users').then(response => {
                    this.users=response.data;
                })
            }
        }
    }
</script>

<style scoped>

</style>