<template>
    <div>
        <div class="card-body">
            <div class="form-group">
                <h1>Team Moderators</h1>
                <label for="Team name"><b>Team Name</b></label>
                <select id="team" name="team" @change="onChangeTeam">
                    <option></option>
                    <option
                            v-for="team in teamsList"
                            :value="team.id"
                    >{{team.team_name}}
                    </option>
                </select>
                <br>
                <label for="Team name"><b>Moderator name</b></label>
                <select id="user" name="user" @change="onChangeUser">
                    <option></option>
                    <option
                            v-for="user in usersList"
                            :value="user.id"
                    >{{user.name}}
                    </option>
                </select>
                <br>
                <button type="submit" @click="submit()">Submit</button>
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