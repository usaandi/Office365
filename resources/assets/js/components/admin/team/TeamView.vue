<template>
    <div>
        <modal v-show="showUpdate">

            <h3 slot="header">
                {{teamName}}
            </h3>

            <div slot="body" class="admin__form admin__form--clear">
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row"><label for="example-text-input"
                                                                     class="col-sm-3 col-xs-12  col-form-label">Team</label>
                        <div class="col-sm-9 col-xs-12 "><input required="" name="departmentName" type="text"
                                                                placeholder="Department Name"
                                                                class="form-control m-input"
                                                                v-model="teamName"></div>
                    </div>

                </div>

            </div>
            <div slot="footer">
                <button type="button" class="btn btn-success" @click="close">CANCEL</button>
                <button type="submit" class="btn btn-danger" @click="submit">SUBMIT</button>
            </div>
        </modal>

        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row m--margin-bottom-15">
                    <div class="col-sm-3 col-xs-12">
                        <div v-show="success" class="alert alert-success alert-dismissible">
                            <a class="close" @click="success=!success"></a>
                            <strong>Success!</strong>
                        </div>

                        <div v-show="deleteStatus" class="alert alert-danger">
                            <p><strong>Delete {{teamName}} ?</strong></p>
                            <div class="btn-group">

                                <button class="btn btn-primary" @click="deleteFalse"><span>Cancel</span></button>

                                <button class="btn btn-danger" @click="deleteTrue"><span>Submit</span></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 col-xs-12">
                        <div class="profile-timeline__action ">
                            <a :href="'admin/team/create'" class="btn btn-success m-btn m-btn--icon m-btn--pill">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>Add Team</span>
                                    </span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>

            <div class="table-responsive">
                <span class="float-left m--margin-bottom-5"></span>
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Team Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr is="admin-team-body"
                        v-for="(team,index) in teamsList"
                        :key="index"
                        :index="index"
                        :team="team"
                        @index="getIndex($event)"
                        @update="edit($event)"
                        @deleteRequest="deleteRequest($event)"
                    >


                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['teams'],
        name: "TeamView",
        data() {
            return {
                teamsList: this.teams,
                showUpdate: false,
                teamName: null,
                teamId: null,
                teamIndex: null,
                success: false,
                deleteStatus: false,
            }
        },
        watch: {
            teamsList(value) {

            },

        },
        methods: {
            getIndex(index) {

                this.teamIndex = index;


            },
            submit() {

                if (teamName) {

                    const data = {
                        teamName: this.teamName
                    };


                    axios.put('/admin/team/' + this.teamId + '/update', data).then(response => {
                        if (response.status === 200) {
                            this.teamsList[this.teamIndex] = response.data;
                            this.showUpdate = false;
                            this.teamName = null;
                            this.teamId = null;
                            this.teamIndex = null;
                            this.success = true;

                        }
                    });
                }

            },
            edit(object) {

                this.teamName = object.team_name;
                this.teamId = object.id;
                this.showUpdate = true;


            },
            deleteFalse() {

                this.teamName = null;
                this.deleteStatus = false;
                this.teamId = null;
                this.teamIndex = null;
            },
            deleteTrue() {


                axios.delete('/admin/team/' + this.teamId + '/delete').then(response => {
                    if (response.status === 200) {
                        this.teamsList.splice(this.teamIndex,1);
                        this.teamName = null;
                        this.deleteStatus = false;
                        this.teamId = null;
                        this.teamIndex = null;
                        this.success = true;
                    }

                });
            },
            deleteRequest(name) {

                this.deleteStatus = true;
                this.teamId = name.id;
                this.teamName = name.team_name;


            },
            close() {
                if (this.showUpdate) {
                    this.showUpdate = false;
                    this.teamName = null;
                    this.teamId = null;
                    this.teamIndex = null;
                }
            }
        }
    }
</script>

<style scoped>

</style>