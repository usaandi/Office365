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
                            <a  class="btn btn-success m-btn m-btn--icon m-btn--pill" @click="showForm">
                                              <span>
                                                <i class="la la-plus"></i>
                                                <span>New</span>
                                              </span>
                            </a>
                            <milestone-form

                                    :usersList="usersList"
                                    v-show="show"
                                    :careerRoleId="userRoleInfo.id"
                                    :selectedUserProfileId="selectedUserProfileId"
                            >
                            </milestone-form>

                        </div>
                <user-career-milestone
                    :canEdit="canEdit"
                    :selectedUserProfileId="selectedUserProfileId"
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
                            <button type="button" @click="canEditCareer()" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Edit</button>
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
        props:['authUserId','userdata','selectedUserProfileId','usersList','canEdit'],
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
                isUpdate:false,

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

            canEditCareer(){
                if(this.canEdit===true){

                    this.isEditing === false ? this.isEditing=true : this.isEditing=false;
                }
            },

            showForm(){

                if(this.canEdit===true){

                    this.show === false ? this.show=true : this.show=false;
                }
            },

            deleteMilestone(value){

                if(this.canEdit===true){

                    let array = this.userRoleInfo['milestones'];
                    let index = array.findIndex(function(obj){
                        return obj.id === value;
                    });
                    const data = this.userRoleInfo['milestones'][index];

                    axios.post('/user/'+this.selectedUserProfileId+'/career/milestone/delete',data).then(response => {});
                    if (index !== -1){
                        array.splice(index,1);
                    }
                }
            },


            focusField(value){
                if(this.isEditing){
                    this.editField = value;
                }
            },
            blurField(){

                if(this.isEditing){
                    let fieldName = this.editField;
                    let fieldValue = this.userRoleInfo[this.editField];
                    const data =  {
                        fieldValue:fieldValue,
                        fieldName:fieldName,
                        id:this.userRoleInfo.id,
                    };
                    axios.post('/user/'+this.selectedUserProfileId +'/career/update',data).then(response => {});
                    this.editField ='';
                }
            },
            showField(value){
                if(this.isEditing){
                    return (this.userRoleInfo[value] === '' || this.editField === value)
                }
            },



        },

    }
</script>

<style scoped>

</style>