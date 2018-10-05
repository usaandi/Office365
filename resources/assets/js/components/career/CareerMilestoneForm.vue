<template>
    <div  class="profile-timeline__form" >
        <form class="m-form">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <label for="Task" class="col-3 col-form-label">Task</label>
                    <div class="col-9" >
                        <input  id="Task" class="form-control m-input" placeholder="Task" v-model="task">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="Assign" class="col-3 col-form-label">Assign</label>
                    <div class="col-9">
                        <select class="form-control m-input" id="Assign" v-model="assignerUserId">
                            <option></option>
                            <option  v-for="user in users" :value="user.id"
                            >
                                {{user.name}}
                            </option>

                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="Reminder" class="col-3 col-form-label">Set reminder</label>
                    <div class="col-9">
                        <input v-model="reminder"  type="date" id="Reminder" class="form-control m-input" placeholder="Task">
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <div class="profile-timeline__action"><button  type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Cancel</button>
                                <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom" @click="submit()">Save</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['careerRoleId', 'selectedUserProfileId', 'usersList'],
        name: "CareerMilestoneForm",
        data() {
            return {
                show: false,
                task: '',
                reminder: '',
                assignerUserId: '',
                users: [],
            }
        },

        mounted() {

            this.users = this.usersList;
        },

        watch: {
            usersList(newValue) {
                this.users = newValue;
            }

        },

        methods: {

            submit() {


                const data = [{
                    taskName: this.task,
                    reminder: this.reminder,
                    assignerUserId: this.assignerUserId,
                    CareerRoleId: this.careerRoleId,
                }];

                this.task = '';
                this.reminder = '';
                this.assignerUserId = '';

                let vm = this;
                axios.post('/user/' + this.selectedUserProfileId + '/career/milestone/create', data)
                    .then(response => {
                    }).catch(error => {

                });
            }
        }
    }
</script>

<style scoped>

</style>