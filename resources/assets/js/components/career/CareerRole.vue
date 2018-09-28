<template>
    <div class="m-timeline-2__item">
        <span class="m-timeline-2__item-time">2020 Jan</span>
        <div class="m-timeline-2__item-cricle">
            <i class="fa fa-genderless m--font-info"></i>
        </div>
        <div class="m-timeline-2__item-text  m--padding-top-5">
            <div class="profile-timeline__content">
                <div class="row">
                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                        <h4 class="profile-timeline__title"
                            v-show="!showField('title')" @click="focusField('title')"
                        >{{userRoleInfo.title}}</h4>

                        <input v-model="userRoleInfo.title" v-show="showField('title')" type="text"
                               @focus="focusField('title')" @blur="blurField">
                    </div>


                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                        <p class="profile-timeline__text"
                        v-show="!showField('description')" @click="focusField('description')">
                           {{userRoleInfo.description}}
                        </p>
                        <textarea v-model="userRoleInfo.description" v-show="showField('description')"
                            @focus="focusField('description')" @blur="blurField"
                        ></textarea>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                        <h4 class="profile-timeline__title">MILESTONES</h4>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                        <div class="profile-timeline__add">
                            <a  class="btn btn-success m-btn m-btn--icon m-btn--pill" @click="show=!show">
                                              <span>
                                                <i class="la la-plus"></i>
                                                <span>New</span>
                                              </span>
                            </a>
                            <milestone-form

                                    :usersList="usersList"
                                    v-show="show"
                                    :careerRoleId="userRoleInfo.career_role_id"
                                    :selectedUserProfileId="selectedUserProfileId"
                            >
                            </milestone-form>

                        </div>
                <user-career-milestone

                    v-for="milestone in userRoleInfo['milestones']"
                    :milestoneInfo="milestone"
                    :key="milestone.id"
                    :usersList="usersList"
                    @removeMilestone="deleteMilestone($event)"
                ></user-career-milestone>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                        <div class="profile-timeline__notes">
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                        <div class="profile-timeline__action">
                            <button type="button" @click="isEditing=!isEditing" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Edit</button>
                            <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom">Apply as current</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios';
    export default {
        props:['authUserId','userdata','selectedUserProfileId','usersList'],
        name: "CareerRole",

        data(){
            return{

                userId:'',
                userRoleInfo:'',
                milestoneInfo:'',
                show:false,
                careerRoleId:'',

                newRoleTitle:'',
                newRoleDescription:'',
                isEditing:false,
                editField:'',
            }
        },
        watch: {
            userdata(newVal) {
                this.userRoleInfo = newVal;
            }
        },

        created(){
            this.userRoleInfo = this.userdata;
            this.milestoneInfo = this.userInfo;

        },
        mounted(){
        },

        methods: {

            deleteMilestone(value){
                console.log('emitted id' + value);
                const data = this.userRoleInfo['milestones'];


                let array = this.userRoleInfo['milestones'];
                let index = this.userRoleInfo['milestones'].findIndex(function(obj){
                    return obj.id === value;
                });
                if (index !== -1){
                    array.splice(index,1);
                }


            /*    if (index !== -1) {
                    vm.userRoleInfo.splice(index, 1);
                }*/
              // Vue.delete(this.userRoleInfo['milestones'],this.userRoleInfo['milestones']);
             /*  this.userRoleInfo.splice(this.userRoleInfo.indexOf(index),1);*/
              /*  console.log(array);
                if(array.milestone_id === index){
                    array.splice(array.milestone_id,0);
                }*/


            },

            focusField(value){
                if(this.isEditing){
                    this.editField = value;
                }

            },
            blurField(){

                if(this.isEditing){
                    this.editField ='';

                }
            },

            showField(value){
                if(this.isEditing){
                    return (this.userRoleInfo[value] === '' || this.editField === value)

                }
            }


        },

    }
</script>

<style scoped>

</style>