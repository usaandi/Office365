<template>
    <div>
        <div class="profile-timeline__milestones">

            <div class="profile-timeline__form" v-show="show">
                <form class="m-form">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <label for="Task" class="col-3 col-form-label">Task</label>
                            <div class="col-9">
                                <input v-model.trim="milestone.task" class="form-control m-input"
                                       @focus="checkError" @change="checkError" type="text"
                                       :class="{'border border-danger': this.errorTask}">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label for="Assign" class="col-3 col-form-label">Assign</label>
                            <div class="col-9">
                                <select class="form-control m-input" @focus="checkError" v-model="selected"
                                        @change="checkError"
                                        :class="{'border border-danger': this.errorSelected}">
                                    <option disabled>current {{milestone.assigned_username}}</option>
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
                            <label for="Reminder" class="col-3 col-form-label">Set reminder</label>
                            <div class="col-9">
                                <input class="form-control m-input" id="Reminder" type="date" @focus="checkError"
                                       @change="checkError"
                                       :class="{'border border-danger': this.errorDate}"
                                       v-model="milestone.reminder">
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12">
                                         <span @click="remove()"><span style="cursor: pointer"
                                                                       class="icon flaticon-delete-1"></span></span>
                                </div>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="profile-timeline__action">
                                        <button @click="show=!show" type="button"
                                                class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Close
                                        </button>
                                        <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom"
                                                @click="focusField()">Save
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
                        <input type="checkbox" @click="submitChange" :checked="milestone.completed === 1">
                        <div
                                class="profile-timeline__milestones--label"
                                style=""
                        > {{milestone.task}}
                        </div>

                        <span></span>

                    </label>

                    <div class="profile-timeline__milestones--name">


                        <div class="m-list-pics m-list-pics--sm">
                            <a :href="'user/'+milestone.assigned_id"><img :src="milestone.assigned_image" title=""></a>

                            {{milestone.assigned_username}}
                        </div>
                    </div>
                    <div class="profile-timeline__milestones--date">
                        {{milestone.reminder}}
                    </div>
                    <div class="profile-timeline__milestones--action">
                        <a tabindex="" @click="focusField()"
                           class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill">
                            <i class="la la-pencil-square"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';


    export default {

        name: "CareerMilestone",
        props: ['milestoneInfo', 'usersList', 'selectedUserProfileId', 'canEdit', 'hasMilestoneError', 'careerRoleMilestoneIndex'],
        data() {
            return {
                selected: '',
                taskName: '',
                assigned: '',
                reminder: '',
                milestone: [],
                editField: '',
                show: false,
                assignerId: '',
                id: '',
                isCompleted: false,

                errors: false,
                errorTask: false,
                errorDate: false,
                errorSelected: false,
            }
        },

        mounted() {

            this.milestone = this.milestoneInfo;
            this.selected = {id: this.milestone.assigned_id, name: this.milestone.assigned_username};
        },

        watch: {

            milestoneInfo(value) {
                this.milestoneInfo = value;
                this.milestone = value;
            }
        },

        methods: {

            submitChange() {
                if (this.canEdit) {
                    this.changeValue();
                }
            },

            changeValue() {

                if (this.canEdit === true) {
                    let vm = this;
                    axios.post('update/milestone/' + this.selectedUserProfileId, {milestoneId: this.milestone.id}).then(response => {
                        if (response.status === 200) {
                            vm.milestone.completed = response.data.value;
                        }
                    });
                }

            },

            checkError() {
                this.$emit('errorValue', this.errors);

                this.milestone.task === '' ? this.errorTask = true : this.errorTask = false;
                this.selected === '' ? this.errorSelected = true : this.errorSelected = false;
                this.milestone.reminder === '' ? this.errorDate = true : this.errorDate = false;

                if (this.errorDate === true || this.errorSelected === true || this.errorTask === true) {
                    this.errors = true;
                }
                else {
                    this.errors = false;
                }
            },

            remove() {
                if (this.canEdit === true) {
                    this.$emit('removeMilestone', this.careerRoleMilestoneIndex);
                }
            },
            submit() {

            },

            focusField() {

                if (this.errors === false) {
                    this.checkError();
                    if (this.canEdit === true) {

                        this.show === false ? this.show = true : this.show = false;
                        this.milestone.assigned_id = this.selected.id;
                        this.milestone.assigned_username = this.selected.name;
                        if (this.show === false) {
                            const data = [{
                                id: this.milestone.id,
                                reminder: this.milestone.reminder,
                                task: this.milestone.task,
                                selected: this.selected,
                                userCareerRoleId: this.milestone.user_career_role_id,
                            }];

                            axios.post('/user/' + this.selectedUserProfileId + '/career/milestone/update', data)
                                .then(response => {

                                    this.show = false;
                                });
                        }
                    }
                }
            },

        }
    }
</script>

<style scoped>

</style>