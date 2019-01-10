<template>
    <div>
        <div class="d-flex align-items-center">

            <div class="mr-auto">
                <div class="m-subheader ">
                    <div class="d-flex align-items-center">
                        <div>
                            <h3 class="m-subheader__title ">
                                Personal development
                            </h3>
                        </div>
                        <div class="m-subheader__action" >
                            <a v-show="!show" tabindex="" class="btn btn-success m-btn m-btn--icon m-btn--pill"
                               @click="showForm">
                            <span>
                                <i class="la la-plus"></i>
                                <span>New</span>
                            </span>
                            </a>
                            <career-role-form
                                    :canEdit="canEdit"
                                    v-show="show"
                                    @cancel="showForm"
                                    @close="show = false"
                                    :selectedUserProfileId="selectedUserId"
                                    :authUserId="AuthUserId"
                                    :hasMilestoneError="hasMilestoneError"
                                    @createRole="newRole($event)"
                                    @remove="removeElement($event)"
                                    @save="saveRole($event)"
                                    @checkMilestoneError="checkErrors($event)"
                            ></career-role-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-timeline">
            <div class="m-timeline-2">
                <div class="m-timeline-2__items">
                    <career-role
                            :hasChanged="hasChanged"
                            :canEdit="canEdit"
                            :authUserId="AuthUserId"
                            v-for="userInfo in sortArray(userDatas)"
                            :userdata="userInfo"
                            :isActive="userInfo.current_role"
                            :key="userInfo.id"
                            :selectedUserProfileId="selectedUserId"
                            :usersList="users"
                            :hasMilestoneError="hasMilestoneError"
                            @errorValue="errorValueSend($event)"
                            @remove="removeElement($event)"
                            @save="saveRole($event)"
                            @selectActive="selectActive($event)"
                            @deleteRole="deleteRole($event)"
                    >
                    </career-role>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['currentUserId'],
        name: "CareerComponent",
        data() {
            return {
                isHidden: false,
                AuthUserId: '',
                selectedUserId: '',
                userDatas: null,
                careerRoleId: '',
                show: false,
                hasChanged: false,
                users: null,
                userModel: '',
                hasMilestoneError: null,
                canEdit: false,
                buttonTextValue: 'New',
            }
        },
        mounted() {
            this.AuthUserId = authUser.id;
            this.selectedUserId = this.currentUserId;
            this.fetchData();
            this.usersList();
            this.fetchUserInfo();
        },
        watch: {
            userDatas(value) {
                this.userDatas = value;
            }
        },
        methods: {
            deleteRole(id) {

                for (let i = 0; i < this.userDatas.length; i++) {
                    if (this.userDatas[i].id === id) {
                        this.userDatas.splice(i, 1);
                    }
                }

            },

            selectActive(careerRoleId) {
                const data = {
                    userCareerRoleId: careerRoleId,
                };
                axios.post('/user/' + this.currentUserId + '/career/role/select', data).then(response => {
                    for (let i = 0; i < this.userDatas.length; i++) {
                        let userRole = this.userDatas[i];
                        if (userRole.id === careerRoleId && userRole.current_role === 0) {
                            userRole.current_role = 1;
                        }
                        if (userRole.id !== careerRoleId && userRole.current_role === 1) {
                            userRole.current_role = 0;
                        }
                    }
                });
            },
            errorValueSend(value) {

                if (this.hasMilestoneError !== value) {
                    this.hasMilestoneError = value;
                }
            },
            checkErrors() {
                this.hasMilestoneError = true;
            },
            sortArray(userDatas) {
                return _.orderBy(userDatas, 'id', 'desc');
            },
            showForm() {
                if (this.canEdit === true) {
                    if (this.hasChanged === false) {
                        this.show === false ? this.show = true : this.show = false;
                    }
                }
            },

            checkCanEdit() {
                if (Vue.$isAdmin() || Vue.$canModerateTeam(this.userModel.team_id)) {
                    this.canEdit = true;
                }
            },
            fetchUserInfo() {
                axios.get('/user/career/info/' + this.currentUserId).then(response => {
                    this.userModel = response.data;
                    this.checkCanEdit();
                });
            },
            usersList() {
                axios.get('/users')
                    .then(response => {
                        this.users = response.data;
                    });
            },
            newRole(value) {
                if (this.canEdit) {

                    this.careerRoleId = value;
                    const data = {
                        careerRoleId: this.careerRoleId,
                    };
                    let vm = this;
                    axios.post('/user/' + this.selectedUserId + '/career/role/create', data)
                        .then(response => {
                            this.userDatas.unshift(response.data[0]);

                        }).catch(error => {
                    });
                    if (this.show === true) {
                        this.show = false;

                    }
                }
            },
            fetchData: function () {
                axios.get('/user/' + this.currentUserId + '/career/info')
                    .then(response => {
                        this.userDatas = response.data;
                    });
            },
        },


    }
</script>

<style scoped>

</style>