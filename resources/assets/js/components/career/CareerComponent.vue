<template>
<div>
    <div class="d-flex align-items-center">

        <div class="mr-auto">
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div>
                        <h3 class="m-subheader__title ">
                            Personal development
                        </h3>
                    </div>
                    <div class="m-subheader__action">
                        <a class="btn btn-success m-btn m-btn--icon m-btn--pill"
                           @click="show=!show" >
                            <span>
                                <i class="la la-plus"></i>
                                <span>New</span>
                            </span>
                        </a>
                        <career-role-form
                                v-show="show"
                                :selectedUserProfileId="selectedUserId"
                                :authUserId="AuthUserId"
                                @createRole="newRole($event)"
                                @remove="removeElement($event)"
                                @save="saveRole($event)"
                        ></career-role-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-timeline">
        <div class="m-timeline-2">
            <div class="m-timeline-2__items" >
            <career-role
                :authUserId="AuthUserId"
                v-for="userInfo in userdatas"
                :userdata="userInfo"
                :key="userInfo.id"
                :selectedUserProfileId="selectedUserId"
                :usersList="users"
            >
            </career-role>
            </div>
        </div>
    </div>

</div>
</template>

<script>
    import axios from 'axios';

    export default {
        props:['currentUserId'],
        name: "CareerModal",
        data(){
            return{
                isHidden:false,
                AuthUserId:'',
                selectedUserId:'',
                userdatas:null,
                careerRoleId:'',
                show:false,
                hasChanged: false,
                users:null,
            }
        },

        mounted(){
            this.AuthUserId = authUser.id;
            this.selectedUserId = this.currentUserId;
            this.fetchData();
            this.usersList();
        },
        methods:{

            usersList(){
                axios.get('/users')
                    .then(response => {
                        this.users = response.data;
                    })
            },

            saveRole(value){

                if(this.hasChanged){

                const data = this.userdatas[0];


                /*console.log(data);*/
                 axios.post('/user/'+this.selectedUserId+'/career/role/save',data)
                    .then(response => {});
                 this.show=false;
                this.hasChanged=false;
                }

            },
            removeElement(){

                if(this.hasChanged){
                    this.userdatas.splice(0, 1);
                    this.hasChanged=false;
                }

            },
            newRole(value){
                this.careerRoleId = value;
                const data = {
                    careerRoleId: this.careerRoleId,
                };
                let vm = this;

                axios.post('/user/'+this.selectedUserId+'/career/role/create',data)
                    .then(response => {
                        if (vm.hasChanged) {
                            Vue.set( vm.userdatas, 0, response.data[0] )
                        }
                        else {
                            vm.hasChanged = true;
                            vm.userdatas.unshift(response.data[0]);
                        }
                    }).catch(error => {});
            },

            fetchData: function () {
                axios.get('/user/' + this.currentUserId + '/career/info')
                    .then(response => {
                        this.userdatas = response.data;
                });
            }
        }
    }
</script>

<style scoped>

</style>