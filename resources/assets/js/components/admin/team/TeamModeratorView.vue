<template>
    <div>
        <modal v-if="show">


            <h3 slot="header">
                {{selectedUser.user_name}}
            </h3>

            <div slot="body" class="admin__form form__body">
                <div class="m-portlet__body">
                    <div>
                        <label>
                            <input @click="checkboxEventModerator" type="checkbox"
                                   :checked="isModerator">
                            <span>User is Moderator</span>
                        </label>

                    </div>
                </div>
                <div>
                    <div>
                        <label>
                            <input @click="checkboxEventBelongs" type="checkbox"
                                   :checked="belongsTeam">
                            <span>User belongs to team</span>
                        </label>
                    </div>
                </div>
            </div>
            <div slot="footer">
                <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom"
                        @click="cancel">
                    CANCEL
                </button>
                <button type="submit" class="btn m-btn--pill btn-success" @click="submit">SUBMIT</button>
            </div>
        </modal>
        <div v-show="finished" class="alert alert-success alert-dismissible">
            <p class="text-center"><strong>Success</strong></p>
            <a class="close" @click="finished=!finished"></a>

        </div>
        <div class="table-responsive">
            <span class="float-left m--margin-bottom-5"></span>
            <table class="table table-bordered text-center">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Moderator</th>
                    <th>Team Member</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(user, index) in teamUsers['users']">
                    <td :key="index"
                        :index="index"
                    ><span>{{user.user_name}}</span></td>
                    <td :style="[user.team_moderator ? {border:'0.2em solid #BEBEBE'} : '' ]"><span><i
                            :class="[user.team_moderator ? 'fas fa-crown':'far fa-times-circle']"
                            style="font-size: 2.3em;"></i></span>
                    </td>
                    <td><span><i :style="'fontSize:2.3em'"
                                 :class="[user.belongs_team ? 'far fa-check-circle':'far fa-times-circle']"></i></span>
                    </td>
                    <td><span><button type="button" @click="selectUser(index)"
                                      class="btn btn-success">Edit User</button></span></td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>

    export default {
        props: {
            teamId: {
                required: true
            },
            teamInfo: {
                required: true
            }

        },
        name: "TeamModeratorView",
        data() {

            return {
                teamUsers: this.teamInfo,
                selectedUser: {},
                show: false,
                currentUserIndex: null,
                isModerator: null,
                finished: false,
                belongsTeam: null,

            }
        },
        watch: {
            selectedUser(oldValue, newValue) {

            },

        },
        methods: {
            checkboxEventModerator() {
                if (this.isModerator) {
                    this.isModerator = false
                } else {
                    this.isModerator = true;
                }


            },
            submit() {
                if (this.show) {
                    const data = {
                        userId: this.selectedUser.user_id,
                        isModerator: this.isModerator,
                        belongsTeam: this.belongsTeam,

                    };

                    console.log(data);

                    this.teamUsers['users'][this.currentUserIndex].team_moderator = this.isModerator;
                    this.teamUsers['users'][this.currentUserIndex].belongs_team = this.belongsTeam;
                    this.show = false;
                    this.finished = true;
                }
            },
            checkboxEventBelongs() {

                if (this.belongsTeam) {
                    this.belongsTeam = false;
                } else {
                    this.belongsTeam = true;
                }

            },
            cancel() {
                if (this.show) {
                    this.show = false;
                    this.belongsTeam = null;
                    this.isModerator = null;
                    this.selectedUser = null;
                    this.currentUserIndex = null;
                }
            },
            selectUser(index) {
                this.selectedUser = this.teamUsers['users'][index];
                this.currentUserIndex = index;
                this.isModerator = this.teamUsers['users'][index].team_moderator;
                this.belongsTeam = this.teamUsers['users'][index].belongs_team;
                this.show = true;
            }
        },


    }
</script>

<style scoped>
    tbody:before {
        /* This doesn't work because of border-collapse */
        line-height: 0.1em;
        content: "_";
        color: white;
        display: block;
    }

    .form__body {
        margin-top: 0;
        width: 100%;
    }

    label {
        display: block;
        padding-left: 15px;
        text-indent: -15px;
    }

    input {
        width: 13px;
        height: 13px;
        padding: 0;
        margin: 0;
        vertical-align: bottom;
        position: relative;
        top: -1px;
        *overflow: hidden;
    }

</style>