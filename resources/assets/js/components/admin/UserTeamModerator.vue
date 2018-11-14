<template>
    <div>
        <div class="admin__form admin__form--clear"><h4>Team Moderator</h4>
            <div class="m-portlet__body">
                <div class="form-group m-form__group row"><label for="user" class="col-sm-3 col-xs-12  col-form-label">User
                    Name</label>
                    <div class="col-sm-9 col-xs-12 ">
                        <select @change="onChangeUser" required name="team" id="user" class="form-control m-input">
                            <option></option>
                            <option v-for="user in usersList"
                                    :value="user.id">{{user.name}}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label for="team" class="col-sm-3 col-xs-12  col-form-label">Team Select</label>
                    <div class="col-sm-9 col-xs-12 "><select @change="onChangeTeam" required name="team" id="team"
                                                             class="form-control m-input">
                        <option></option>
                        <option
                                v-for="team in teamsList"
                                :value="team.id">
                            {{team.team_name}}
                        </option>
                    </select>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12"></div>
                        <div class="col-sm-9 col-xs-12">
                            <div class="profile-timeline__action">
                                <button @click="submit()" type="submit" class="btn btn-success m-btn m-btn--pill">
                                    <span><span>Submit</span></span></button>
                            </div>
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
        props: ['users', 'teams'],
        name: "TeamModerator",
        data() {
            return {
                usersList: [],
                teamsList: [],
                userId: '',
                teamId: '',
            }
        },
        mounted() {
            this.usersList = this.users;
            this.teamsList = this.teams;
        },
        methods: {
            onChangeUser(event) {
                this.userId = event.target.value;
            },
            onChangeTeam(event) {
                this.teamId = event.target.value;
            },
            submit() {
                let data = JSON.stringify({
                    userId: this.userId,
                    teamId: this.teamId,

                });
                axios.post('/admin/team/moderator/add', data)
                    .then(response => {


                    }).catch(error => {
                });
            }

        }
    }
</script>

<style scoped>

</style>