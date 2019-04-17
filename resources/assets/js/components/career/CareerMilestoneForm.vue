<template>
    <div class="profile-timeline__form">
        <form class="m-form">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <label for="Task" class="col-3 col-form-label">Task</label>
                    <div class="col-9">
                        <input @change="thisChanged" id="Task" :class="{'border border-danger': this.errorTask}"
                               class="form-control m-input" placeholder="Task" v-model="task">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="Assign" class="col-3 col-form-label">Assign</label>
                    <div class="col-9">
                        <select class="form-control m-input" @change="thisChanged"
                                :class="{'border border-danger': this.errorSelected}" id="Assign" v-model="selected">
                            <option></option>
                            <option v-for="user in users" :value="user"
                            >
                                {{user.name}}
                            </option>

                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="description" class="col-3 col-form-label">Description</label>
                    <div class="col-9">
                        <textarea rows="5" id="description" required class="form-control m-input"
                                  placeholder="description"
                                  v-model="description"></textarea>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="milestoneReminder" class="col-3 col-form-label">Set reminder</label>
                    <div class="col-9">
                        <input v-model="reminder" @change="thisChanged"
                               :class="{'border border-danger': this.errorReminder}" type="text" readonly
                               :id="'milestoneReminder'+this.careerRoleId"
                               class="form-control m-input" placeholder="Reminder">
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <div class="profile-timeline__action">
                                <button @click="clear()" type="button"
                                        class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Close
                                </button>
                                <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom"
                                        @click="submit()">Save
                                </button>
                            </div>
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
                hasError: false,


                show: false,
                errorTask: false,
                errorReminder: false,
                errorSelected: false,
                description: null,
                selected: '',
                task: '',
                reminder: '',
                assignerUserId: '',
                users: [],
                dangerBorder: 'border border-danger'
            }
        },

        mounted() {

            let id = this.careerRoleId;

            $('#milestoneReminder' + id).datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
            }).on('changeDate', event => {

                this.reminder = event.target.value;
            });
            this.users = this.usersList;
        },

        computed: {},
        watch: {
            usersList(newValue) {
                this.users = newValue;
            }

        },

        methods: {
            clear() {
                this.task = '';
                this.reminder = '';
                this.selected = '';
                this.errorTask = false;
                this.errorReminder = false;
                this.errorSelected = false;
                this.$emit('close');

            },
            thisChanged() {


                if (this.hasError) {
                    this.hasError = false;
                }
                if (this.task !== '') {
                    this.errorTask = false;
                }
                if (this.selected !== '') {
                    this.errorSelected = false;
                }
                if (this.reminder !== '') {
                    this.errorReminder = false;
                }
            },

            submit() {


                this.task === '' ? this.errorTask = true : this.errorTask = false;

                this.selected === '' ? this.errorSelected = true : this.errorSelected = false;

                this.reminder === '' ? this.errorReminder = true : this.errorReminder = false;


                if (this.task !== '' && this.selected !== '' && this.reminder !== '') {
                    this.hasError = false;


                    const data = [{
                        taskName: this.task,
                        reminder: this.reminder,
                        assignerUserId: this.selected.id,
                        description: this.description,
                        CareerRoleId: this.careerRoleId,
                    }];

                    this.description = null;
                    this.task = '';
                    this.reminder = '';
                    this.assignerUserId = '';
                    this.selected = {};

                    let vm = this;
                    axios.post('/user/' + this.selectedUserProfileId + '/career/milestone/create', data)
                        .then(response => {

                            this.$emit('addToMilestones', response.data);
                            vm.$emit('close');


                        }).catch(error => {

                    });


                } else {
                    this.hasError = true;

                }
            },

        }
    }
</script>

<style scoped>

</style>