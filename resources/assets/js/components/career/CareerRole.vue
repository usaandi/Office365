<template>
    <div class="m-timeline-2__item">

        <span v-if="createdDate" class="m-timeline-2__item-time">{{returnDate}}</span>
        <span v-else="!createdDate" class="m-timeline-2__item-time">Date not set</span>
        <div class="m-timeline-2__item-cricle">
            <i class="fa fa-genderless"
               :class="[{'m--font-success': isActive === 1,'m--font-info': isActive=== 0 }]"></i>
        </div>
        <div class="m-timeline-2__item-text  m--padding-top-5 ">

            <div v-show="success" class="alert alert-success alert-dismissible">
                <a class="close" @click="success=!success"></a>
                <strong>Success!</strong>
            </div>

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

                <div v-show="isEditing">
                    <div class="admin__form">
                        <div class="m-portlet__body">

                            <div class="form-group m-form__group row">
                                <label for="title" class="col-3 col-form-label">Role</label>

                                <div class="col-9"><input id="title" v-model="roleValue" type="text" name="title"
                                                          placeholder="Role"
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
                            <div class="form-group m-form__group row">
                                <label for="description" class="col-3 col-form-label">Date</label>
                                <div class="col-sm-9 col-xs-12"><input type="date" v-model="dateValue"
                                                                       id="date"
                                                                       class="form-control m-input"
                                                                       name="career_description">
                                </div>
                            </div>

                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <div class="row">
                                    <div class="col-sm-3 col-xs-12">
                                        <button @click="deleteRequest()"
                                                class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill">
                                            <i
                                                    class="icon flaticon-delete-1"></i></button>
                                    </div>
                                    <div class="col-sm-9 col-xs-12">
                                        <div class="profile-timeline__action">

                                            <button @click="clear()" type="button"
                                                    class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">
                                                Close
                                            </button>
                                            <button type="submit" @click="submitChanges"
                                                    class="btn btn-success m-btn m-btn--pill">
                                                <span><span>Submit</span></span></button>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                        <h4 class="profile-timeline__title">MILESTONES</h4>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">

                        <user-career-milestone
                                :canEdit="canEdit"
                                :selectedUserProfileId="selectedUserProfileId"
                                v-for="(milestone, index) in userMilestones"
                                :milestoneInfo="milestone"
                                :key="index+1"
                                :hasMilestoneError="hasMilestoneError"
                                :usersList="usersList"
                                :careerRoleMilestoneIndex="index"
                                @removeMilestone="deleteMilestone($event)"

                        ></user-career-milestone>
                        <div class="profile-timeline__add">
                            <a v-show="!show" class="btn btn-success m-btn m-btn--icon m-btn--pill" tabindex=""
                               @click="showForm">
                                              <span>
                                                <i class="la la-plus"></i>
                                                <span>Add Milestone</span>
                                              </span>
                            </a>
                            <milestone-form v-show="show"

                                            :usersList="usersList"
                                            :careerRoleId="userRoleInfo.id"
                                            :selectedUserProfileId="selectedUserProfileId"
                                            @pushToMilestones="pushMilestone($event)"
                                            @addToMilestones="addMilestone($event)"
                                            @close="show=false"
                                            @removeMilestone="deleteMilestone($event)"

                            >
                            </milestone-form>

                        </div>
                    </div>
                </div>
                <div class="row" v-show="!isEditing">
                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                        <div class="profile-timeline__notes">
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                        <div class="profile-timeline__action">
                            <button type="button" @click="canEditCareer()"
                                    class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Edit
                            </button>
                            <button @click="selectRole(userRoleInfo.id)" type="button"
                                    v-show="isActive === 0"
                                    class="btn m-btn--pill btn-success m-btn m-btn--custom">Apply as current
                            </button>
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
            'usersList', 'canEdit', 'hasMilestoneError', 'isActive'],

        name: "CareerRole",

        data() {
            return {

                userId: '',
                userRoleInfo: this.userdata,
                milestoneInfo: this.userInfo,
                show: false,
                isCurrent: false,
                userMilestones: this.userdata['milestones'],
                careerRoleId: '',
                newRoleTitle: '',
                newRoleDescription: '',
                selectedActive: undefined,
                isEditing: false,
                buttonValue: 'New',
                createdDate: this.userdata.creation_date,
                editField: '',
                isUpdate: false,
                descriptionValue: null,
                roleValue: null,
                success: false,
                dateValue: null,
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

        },
        mounted() {
            this.currentlySelected();
        },
        computed: {
            sortArray(array) {


            },

            returnDate() {


                let date = new Date(this.createdDate),
                    locale = "en-us";
                let yearCreated = date.getUTCFullYear();
                let monthCreated = date.toLocaleString(locale, {month: 'short'});

                return yearCreated + ' ' + monthCreated;

            }

        },


        methods: {

            deleteRequest() {
                if (this.canEdit) {

                    let confirmation = confirm("Are you sure you want to delete this Career: " + this.userRoleInfo.title);

                    if (confirmation) {
                        axios.delete('/user/' + this.selectedUserProfileId + '/career/delete', {params: {careerId: this.userRoleInfo.id}})
                            .then(response => {
                                const data = response.data;
                                this.$emit('deleteRole', data);
                                this.success = true;
                            })
                    }

                }
            },
            selectRole(value) {

                if (this.canEdit) {

                    this.$emit('selectActive', value);
                }


            },
            submitChanges() {
                if (this.canEdit) {
                    if (this.descriptionValue || this.roleValue || this.dateValue) {

                        const data = {
                            roleTitle: this.roleValue,
                            descriptionValue: this.descriptionValue,
                            careerId: this.userRoleInfo.id,
                            creationDate: this.dateValue,
                        };
                        let vm = this;

                        axios.patch('user/' + this.selectedUserProfileId + '/career/update', data).then(response => {
                            if (response.status === 200) {
                                this.userRoleInfo = response.data;

                                this.createdDate = response.data.creation_date;
                                this.isEditing = false;
                                this.roleValue = null;
                                this.dateValue = null;
                                this.descriptionValue = null;
                                this.success = true;

                            }
                        });

                    }
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
            clear() {
                if (this.canEdit === true) {

                    this.roleValue = null;
                    this.dateValue = null;
                    this.descriptionValue = null;
                    this.isEditing = false;


                }
            },
            canEditCareer() {
                if (this.canEdit === true) {
                    this.isEditing === false ? this.isEditing = true : this.isEditing = false;
                    if (this.isEditing === true) {
                        this.descriptionValue = this.userRoleInfo.description;
                        this.roleValue = this.userRoleInfo.title;
                        this.dateValue = this.userRoleInfo.creation_date;
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


            addMilestone(data) {
                this.userMilestones.push(data[0]);
            },


            showForm() {
                if (this.canEdit === true) {
                    this.show === false ? this.show = true : this.show = false;
                }
            },
            deleteMilestone(value) {


                if (this.canEdit === true) {

                    const data = this.userMilestones[value];
                    axios.post('/user/' + this.selectedUserProfileId + '/career/milestone/delete', data).then(response => {
                        if (response.status === 200) {
                            this.userMilestones.splice(value, 1);
                            this.show = false;
                        }

                    });


                }
            },

        },

    }
</script>

<style scoped>

</style>