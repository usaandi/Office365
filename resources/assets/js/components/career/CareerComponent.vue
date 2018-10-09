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
                           @click="showForm" >
                            <span>
                                <i class="la la-plus"></i>
                                <span>New</span>
                            </span>
                        </a>
                        <career-role-form
                                :canEdit="canEdit"
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
                :hasChanged="hasChanged"
                :canEdit="canEdit"
                :authUserId="AuthUserId"
                v-for="userInfo in sortArray(userDatas)"
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
                userDatas:null,
                careerRoleId:'',
                show:false,
                hasChanged: false,
                users:null,
                userInfo:'',

                canEdit:false,
            }
        },
        mounted(){
            this.AuthUserId = authUser.id;
            this.selectedUserId = this.currentUserId;

            this.fetchData();
            this.usersList();
            this.fetchUserInfo();


        },
        methods:{

            sortArray(userDatas){
                return _.orderBy(userDatas,'id','desc');

            },

            showForm(){

                if(this.canEdit===true){

                    this.show === false ? this.show=true : this.show=false;
                }
            },

            checkCanEdit(){
                if (Vue.$isAdmin() || Vue.$canModerateTeam(this.userInfo.team_id)){
                    this.canEdit = true;
                }
            },
            fetchUserInfo(){
                axios.get('/user/career/info/'+this.currentUserId).then(response => {
                    this.userInfo = response.data;
                    this.checkCanEdit();
                });
            },
            usersList(){
                axios.get('/users')
                    .then(response => {
                        this.users = response.data;
                    })
            },

            saveRole(value){
                if(this.canEdit===true){
                    if(this.hasChanged){


                    const data = this.userDatas[0];
                     axios.post('/user/'+this.selectedUserId+'/career/role/save',data)
                        .then(response => {});
                     this.show = false;
                    this.hasChanged = false;
                   }
                }
            },
            removeElement(){

                if(this.canEdit===true){
                    if(this.hasChanged){
                        this.userDatas.splice(0, 1);
                        this.hasChanged = false;
                    }
                }
            },
            newRole(value){
                if(this.canEdit===true){
                    this.careerRoleId = value;
                    const data = {
                        careerRoleId: this.careerRoleId,
                    };
                    let vm = this;

                    axios.post('/user/'+this.selectedUserId+'/career/role/create',data)
                        .then(response => {
                            if (vm.hasChanged) {
                                Vue.set( vm.userDatas, 0, response.data[0])
                            }
                            else {
                                vm.hasChanged = true;
                                vm.userDatas.unshift(response.data[0]);
                            }
                        }).catch(error => {});
                }
            },

            fetchData: function () {
                axios.get('/user/' + this.currentUserId + '/career/info')
                    .then(response => {
                        this.userDatas = response.data;
                });
            }
        }
    }
</script>

<style scoped>

</style>