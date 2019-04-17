<template>
    <div>
        <div class="profile-timeline__milestones">

            <div class="profile-timeline__form" v-show="show">
                <form class="m-form">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <label for="Task" class="col-3 col-form-label">Task</label>
                            <div class="col-9">
                                <input v-model.trim="taskName" class="form-control m-input" id="Task"
                                       @focus="checkError" @change="checkError" type="text"
                                       :class="{'border border-danger': this.errorTask}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label for="Assign" class="col-3 col-form-label">Assign</label>
                            <div class="col-9">
                                <select class="form-control m-input" @focus="checkError" v-model="assigned" id="Assign"
                                        @change="checkError"
                                        :class="{'border border-danger': this.errorSelected}">
                                    <option disabled>Current {{milestoneInfo['assigned_username']}}</option>
                                    <option
                                            v-for="user in usersList"
                                            :value="user"
                                    >
                                        {{user.name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label for="description" class="col-3 col-form-label">Description</label>
                            <div class="col-9">
                        <textarea id="description" required class="form-control m-input" placeholder="description"
                                  v-model="description" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label :for="'reminderMilestone'+this.milestoneInfo.id" class="col-3 col-form-label">Set
                                reminder</label>
                            <div class="col-9">
                                <input class="form-control m-input" :id="'reminderMilestone'+this.milestoneInfo.id"
                                       readonly type="text" @focus="checkError"
                                       @change="checkError"
                                       :class="{'border border-danger': this.errorDate}"
                                       v-model="reminder">
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12">
                                         <span @click="removeMilestone()"><span style="cursor: pointer"
                                                                                class="icon flaticon-delete-1"></span></span>
                                </div>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="profile-timeline__action">
                                        <button @click="cancelMilestoneUpdate" type="button"
                                                class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Close
                                        </button>
                                        <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom"
                                                @click="updateMilestone()">Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <div class="m-form__group form-group" v-show="!show">
                <div class="m-checkbox-list">
                    <label :value="milestone.id"
                           class="m-checkbox m-checkbox--air m-checkbox--state-success">
                        <input type="checkbox" @change="submitChange" v-model="isCompleted">
                        <div
                                class="profile-timeline__milestones--label"
                                style=""
                        > {{milestone.task}}
                        </div>

                        <span></span>

                    </label>

                    <div class="profile-timeline__milestones--name">


                        <div class="m-list-pics m-list-pics--sm">
                            <a :href="'user/'+milestone.assigned_id"><img :src="image" title=""></a>
                            {{setName}}
                        </div>
                    </div>
                    <div class="profile-timeline__milestones--date">
                        {{milestone.reminder}}
                    </div>

                    <div class="profile-timeline__milestones--action">
                        <a tabindex="" @click="show=true"
                           class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill">
                            <i class="la la-pencil-square"></i>
                        </a>
                    </div>
                </div>
                <div class="profile-timeline__milestones--name">
                    {{milestone.description}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';


    export default {

        name: "CareerMilestone",
        props: ['milestoneInfo', 'usersList',
            'selectedUserProfileId', 'canEdit',
            'hasMilestoneError', 'careerRoleMilestoneIndex'],
        data() {
            return {
                selected: '',
                taskName: this.milestoneInfo['task'],
                assigned: {
                    'id': this.milestoneInfo['assigned_id'],
                    'name': this.milestoneInfo['assigned_username'],
                },
                reminder: this.milestoneInfo['reminder'],
                description: this.milestoneInfo['description'],
                milestone: [],
                editField: '',
                image: this.milestoneInfo['assigned_image'],
                show: false,
                assignerId: '',
                id: '',
                isCompleted: this.milestoneInfo['completed'],
                errors: false,
                errorTask: false,
                errorDate: false,
                errorSelected: false,
            }
        },

        mounted() {
            let id = this.milestoneInfo.id;
            $('#reminderMilestone' + id).datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
            }).on('changeDate', event => {

                this.reminder = event.target.value;
            });

            if (this.image) {
            } else {
                this.image = './assets/default/avatar.png';
            }

            this.milestone = this.milestoneInfo;
            this.selected = {id: this.milestone.assigned_id, name: this.milestone.assigned_username};
        },

        watch: {

            milestoneInfo(value) {
                this.milestoneInfo = value;
                this.milestone = value;
            }
        },
        computed: {

            setName() {
                return this.selectedUserProfileId === this.milestone.assigned_id ? 'Me' : this.milestone.assigned_username;

            }
        },

        methods: {

            cancelMilestoneUpdate() {
                this.taskName = this.milestoneInfo['task'];
                this.assigned = {
                    'id': this.milestoneInfo['assigned_id'],
                    'name': this.milestoneInfo['assigned_username'],
                };
                this.reminder = this.milestoneInfo['reminder'];
                this.description = this.milestoneInfo['description'];
                this.show = false;
            },


            updateMilestone() {
                if (this.canEdit) {

                    this.show = true;

                    if (this.checkError()) {

                        const data = {
                            id: this.milestone.id,
                            reminder: this.reminder,
                            description: this.description,
                            task: this.taskName,
                            selected: this.assigned,
                            userCareerRoleId: this.milestone.user_career_role_id,
                        };

                        axios.post('/user/' + this.selectedUserProfileId + '/career/milestone/update', data)
                            .then(response => {
                                if (response.status === 200) {
                                    this.milestone.reminder = response.data['reminder'];
                                    this.milestone.task = response.data['task'];
                                    this.milestone.description = response.data['description'];
                                    this.show = false;
                                    for (let i = 0; i < this.usersList.length; i++) {
                                        if (this.usersList[i].id === response.data.assigned_id) {
                                            this.milestone.assigned_username = this.usersList[i].name;
                                            this.milestone.assigned_id = this.usersList[i].id;
                                        }
                                    }
                                    this.show = false;
                                }
                            });
                    }
                }
            },
            submitChange() {
                if (this.canEdit) {
                    this.changeValue();
                }
            },

            changeValue() {
                if (this.canEdit === true) {

                    let vm = this;
                    axios.post('update/milestone/' + vm.selectedUserProfileId, {
                        milestoneId: vm.milestone.id,
                        status: vm.isCompleted
                    }).then(response => {
                        if (response.status === 200) {
                            vm.milestone.completed = response.data.value;
                        }
                    });
                }
            },

            checkError() {

                this.taskName === '' ? this.errorTask = true : this.errorTask = false;
                this.assigned === '' ? this.errorSelected = true : this.errorSelected = false;
                this.reminder === '' ? this.errorDate = true : this.errorDate = false;


                if (this.errorDate || this.errorSelected || this.errorTask) {

                    return false;
                }

                else {
                    if (this.taskName !== this.milestoneInfo['task'] || this.description !== this.milestoneInfo['description'] ||
                        this.reminder !== this.milestoneInfo['reminder'] || this.assigned['id'] !== this.milestoneInfo['assigned_id']) {
                        return true;
                    }
                }
            },
            removeMilestone() {

                if (this.canEdit) {
                    this.show = false;
                    this.$emit('removeMilestone', this.careerRoleMilestoneIndex);
                }
            },
            submit() {

            },

        },


    }
</script>

<style scoped>

</style>