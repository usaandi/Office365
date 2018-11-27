<template>
    <div class="m-timeline-2__item">
        <span class="m-timeline-2__item-time">{{returnDate}}</span>
        <div class="m-timeline-2__item-cricle"><i
                class="fa fa-genderless"
                :class="[{'m--font-success': isActive === 1,'m--font-info': isActive=== 0 }]"></i></div>
        <div class="m-timeline-2__item-text  m--padding-top-5 ">
            <div class="profile-timeline__content " :class="[{'border border-success': isActive === 1}]">
                <div v-if="isActive === 1" class="profile-timeline__check--wrapper">
                    <div class="profile-timeline__check"></div>
                    <div class="profile-timeline__check--icon"><i class="la la-check"></i></div>
                </div>
                <div class="row" v-show="!isEditing">
                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                        <h4 class="profile-timeline__title"
                        >{{userRoleInfo.title}}</h4>


                    </div>


                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                        <p class="profile-timeline__text">

                            {{userRoleInfo.description}}
                        </p>


                    </div>
                </div>
                <div class="row " v-show="isEditing">
                    <div class="admin__form admin__form--clear">
                        <form class="m-form" method="post" action="#">

                            <div class="m-portlet__body">

                                <div class="form-group m-form__group row">
                                    <label for="title" class="col-3 col-form-label">Title</label>

                                    <div class="col-9"><input id="title" v-model="titleValue" type="text" name="title"
                                                              placeholder="Title"
                                                              class="form-control m-input">
                                    </div>
                                </div>


                                <div class="form-group m-form__group row">
                                    <label for="description" class="col-3 col-form-label">Description</label>
                                    <div class="col-sm-9 col-xs-12"><textarea v-model="descriptionValue"
                                                                              id="description" rows="10"
                                                                              class="form-control m-input"
                                                                              name="career_description"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <div class="row">
                                        <div class="col-sm-3 col-xs-12"></div>
                                        <div class="col-sm-9 col-xs-12">
                                            <div class="profile-timeline__action">
                                                <button type="submit" class="btn btn-success m-btn m-btn--pill">
                                                    <span><span>Submit</span></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                        <h4 class="profile-timeline__title">MILESTONES</h4>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                        <div class="profile-timeline__add" >
                            <a v-show="!show"   class="btn btn-success m-btn m-btn--icon m-btn--pill" @click="showForm">
                                              <span>
                                                <i class="la la-plus"></i>
                                                <span>New</span>
                                              </span>
                            </a>
                            <milestone-form v-show="show"
                                    :hasChanged="hasChanged"
                                    :usersList="usersList"
                                    :careerRoleId="userRoleInfo.id"
                                    :selectedUserProfileId="selectedUserProfileId"
                                    @pushToMilestones="pushMilestone($event)"
                                    @addToMilestones="addMilestone($event)"
                                    @close="show=false"
                            >
                            </milestone-form>

                        </div>
                        <user-career-milestone
                                :canEdit="canEdit"
                                :selectedUserProfileId="selectedUserProfileId"
                                v-for="(milestone, index) in userRoleInfo['milestones']"
                                :milestoneInfo="milestone"
                                :key="index+1"
                                :hasMilestoneError="hasMilestoneError"
                                :usersList="usersList"
                                :careerRoleMilestoneIndex="index"
                                @removeMilestone="deleteMilestone($event)"
                                @errorValue="sendErrorValue($event)"
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
                            <button type="button" @click="canEditCareer()" v-show="!this.hasChanged"
                                    class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Edit
                            </button>
                            <button @click="selectRole(userRoleInfo.id)" type="button"
                                    v-show="!this.hasChanged && isActive === 0"
                                    class="btn m-btn--pill btn-success m-btn m-btn--custom">Apply as current
                            </button>
                            <button @click="save" v-show="this.userRoleInfo.id === 'undefined'"
                                    class="btn btn-success m-btn m-btn--pill"><span><span>Save</span></span></button>
                            <button @click="remove" v-show="this.userRoleInfo.id === 'undefined'"
                                    class="btn btn-danger m-btn m-btn--pill"><span><span>Cancel</span></span></button>
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
        props: ['authUserId', 'userdata', 'selectedUserProfileId',
            'usersList', 'canEdit', 'hasChanged', 'hasMilestoneError', 'isActive'],

        name: "CareerRole",

        data() {
            return {

                userId: '',
                userRoleInfo: '',
                milestoneInfo: '',
                show: false,
                isCurrent: false,
                careerRoleId: '',
                newRoleTitle: '',
                newRoleDescription: '',
                selectedActive: undefined,
                isEditing: false,
                buttonValue: 'New',
                createdDate: this.userdata.created_at,
                editField: '',
                isUpdate: false,
                descriptionValue: '',
                titleValue: '',
            }
        },
        watch: {

            milestone() {

            },
            userdata(newVal) {
                this.userRoleInfo = newVal;
            },
            isActive(value) {
                this.isActive = value;
            }
        },

        created() {
            this.userRoleInfo = this.userdata;
            this.milestoneInfo = this.userInfo;

        },
        mounted() {
            this.currentlySelected();
        },
        computed: {

            returnDate() {

                let date = new Date(this.createdDate),
                    locale = "en-us";
                let yearCreated = date.getUTCFullYear();
                let monthCreated = date.toLocaleString(locale, {month: 'short'});

                return yearCreated + ' ' + monthCreated;

            }

        },


        methods: {
            showButton() {
                if (!this.hasChanged) {
                    return true;
                }
            },

            selectRole(value) {

                if (this.canEdit) {

                    this.$emit('selectActive', value);
                }


            },
            currentlySelected() {
                if (this.canEdit) {
                    if (this.userRoleInfo.current_role === 1) {
                        this.isCurrent = true;
                    }
                    else {
                        this.iscurrent = false;
                    }
                }
            },

            remove() {
                if (this.canEdit === true) {
                    this.$emit('remove');
                }
            },
            save() {
                if (this.canEdit === true) {
                    this.$emit('save', true);
                }
            },

            sendErrorValue(value) {

                /* this.$emit('errorValue',value);*/

            },

            addMilestone(data) {
                this.userRoleInfo['milestones'].push(data[0]);
            },
            pushMilestone(data) {
                if (this.hasChanged === true) {
                    this.userRoleInfo['milestones'].push(data[0]);
                }
            },
            canEditCareer() {
                if (this.canEdit === true) {
                    this.isEditing === false ? this.isEditing = true : this.isEditing = false;
                    if (this.isEditing === true) {
                        this.descriptionValue = this.userRoleInfo.description;
                        this.titleValue = this.userRoleInfo.title;
                    }
                }
            },
            showForm() {
                if (this.canEdit === true) {
                    this.show === false ? this.show = true : this.show = false;

                    if (this.show) {
                        this.buttonValue = 'Close';
                    }
                    else this.buttonValue = 'New';
                }
            },
            deleteMilestone(value) {


                if (this.canEdit === true) {
                    if (this.hasChanged === true) {

                        this.userRoleInfo['milestones'].splice(value, 1);

                    }
                    else if (this.hasChanged === false) {

                        const data = this.userRoleInfo['milestones'][value];
                        axios.post('/user/' + this.selectedUserProfileId + '/career/milestone/delete', data).then(response => {
                        });
                        this.userRoleInfo['milestones'].splice(value, 1);
                    }

                }
            },

        },

    }
</script>

<style scoped>

</style>