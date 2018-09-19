<template>
    <div class="m-timeline-2__item">
        <span class="m-timeline-2__item-time">2020 Jan</span>
        <div class="m-timeline-2__item-cricle">
            <i class="fa fa-genderless m--font-info"></i>
        </div>
        <div class="m-timeline-2__item-text  m--padding-top-5">
            <div class="profile-timeline__content">
                <div class="row">
                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                        <h4 class="profile-timeline__title">{{userRoleInfo.title}}</h4>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                        <p class="profile-timeline__text">
                           {{userRoleInfo.description}}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                        <h4 class="profile-timeline__title">MILESTONES</h4>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                        <div class="profile-timeline__add">
                            <a  class="btn btn-success m-btn m-btn--icon m-btn--pill">
                                              <span>
                                                <i class="la la-plus"></i>
                                                <span>New</span>
                                              </span>
                            </a>
                            <milestone-form></milestone-form>
                        </div>

                <user-career-milestone
                    v-for="milestone in userRoleInfo['milestones']"
                    :milestoneInfo="milestone"
                    :key="milestone.id"
                ></user-career-milestone>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                        <div class="profile-timeline__notes">
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                        <div class="profile-timeline__action">
                            <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Edit</button>
                            <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom">Apply as current</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props:['authUserId','userdata'],
        name: "CareerRole",

        data(){
            return{
                userId:'',
                userRoleInfo:'',
                milestoneInfo:'',
            }
        },

        mounted(){
            this.userRoleInfo = this.userdata;
            this.milestoneInfo = this.userInfo;
        },

        methods: {

        },

    }
</script>

<style scoped>

</style>