<template>
    <div>
        <div v-show="finished" class="alert alert-success alert-dismissible">
            <p class="text-center"><strong>Success</strong></p>
            <a class="close" @click="finished=!finished"></a>
        </div>
        <div class="admin__form admin__form--clear"><h4>User list</h4>
            <div class="m-portlet__body">
                <div class="form-group m-form__group row"><label for="user" class="col-sm-3 col-xs-12  col-form-label">User
                    Name</label>
                    <div class="col-sm-9 col-xs-12 ">
                        <select @change="onChangeUser" required name="team" id="user"
                                class="form-control m-input">
                            <option></option>
                            <option v-for="(user,index) in usersList"
                                    :value="user.user_id"
                                    @click="selectIndex(index)">{{user.user_name}}
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
        props: ['users', 'teamId'],
        name: "TeamModerator",
        data() {
            return {
                usersList: this.users,

                userId: '',
                finished: false,
                userIndex: null,

            }
        },
        mounted() {


        },
        methods: {
            onChangeUser(event) {
                this.userId = event.target.value;
            },
            selectIndex(index) {
                this.userIndex = index;
            },

            submit() {
                if (this.userId) {

                    const data = {
                        userId: this.userId
                    };

                    axios.post('/admin/team/moderator/add/' + this.teamId, data)
                        .then(response => {
                            if (response.status === 200) {
                                this.userId = null;
                                this.finished = true;

                            }

                        }).catch(error => {
                    });
                }
            }


        }
    }
</script>

<style scoped>

</style>