<template>
    <div>
        <div class="profile-timeline__milestones">
            <div class="m-form__group form-group">
                <div class="m-checkbox-list">
                    <label v-show="!show" :value="milestone.id"
                           class="m-checkbox m-checkbox--air m-checkbox--state-success">
                        <input type="checkbox" @click="submitChange" :checked="milestone.completed === 1">
                        <div
                                class="profile-timeline__milestones--label"
                                v-show="!show"
                                style=""
                        > {{milestone.task}}
                        </div>

                        <span></span>

                    </label>

                    <div class="profile-timeline__milestones--name">

                        <input v-model.trim="milestone.task" v-show="show"
                               @focus="checkError" @change="checkError" type="text" class=""
                               :class="{'border border-danger': this.errorTask}">

                        <input type="date" @focus="checkError" @change="checkError"
                               :class="{'border border-danger': this.errorDate}"
                               v-show="show" v-model="milestone.reminder">

                        <select @focus="checkError" v-model="selected" @change="checkError" v-show="show"
                                :class="{'border border-danger': this.errorSelected}">
                            <option></option>
                            <option
                                    v-for="user in usersList"
                                    :value="user"

                            >
                                {{user.name}}
                            </option>
                        </select>

                        <span v-show="show" @click="remove()"><span style="cursor: pointer"
                                                                    class="icon flaticon-delete-1"></span></span>

                        <div v-show="!show" class="m-list-pics m-list-pics--sm">
                            <a href=""><img src="" title=""></a>

                            {{milestone.assigned_username}}
                        </div>
                    </div>
                    <div class="profile-timeline__milestones--date">
                        {{milestone.reminder}}
                    </div>
                    <div class="profile-timeline__milestones--action">
                        <a tabindex=""  @click="focusField()"
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

            submitChange(){
              if(this.canEdit){
                  this.changeValue();
              }
            },

            changeValue() {

                if (this.canEdit === true) {
                    let vm = this;
                    axios.post('update/milestone/'+this.selectedUserProfileId, {milestoneId: this.milestone.id}).then(response => {
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