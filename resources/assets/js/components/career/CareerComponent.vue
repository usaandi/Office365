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
                    <div class="m-subheader__action">
                        <a href="" class="btn btn-success m-btn m-btn--icon m-btn--pill">
                            <span>
                                <i class="la la-plus"></i>
                                <span>New</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-timeline">
        <div class="m-timeline-2">
            <div class="m-timeline-2__items" >
            <career-role
                    :authUserId="AuthUserId" v-for="userInfo in userdatas" :userdata="userInfo" :key="userInfo.id">
            </career-role>
            </div>
        </div>
    </div>

</div>
</template>

<script>
    import axios from 'axios';

    export default {
        props:['currentUserId'],
        name: "CareerModal",
        data(){
            return{
                isHidden:false,
                AuthUserId:'',
                selectedUserId:'',
                userdatas:null,
            }
        },


        mounted(){
            this.AuthUserId = authUser.id;
            this.fetchData();
        },
        methods:{


            fetchData: function () {
                axios.get('/user/' + this.currentUserId + '/career/info')
                    .then(response => {
                        this.userdatas = response.data;
                    });

            }
        }

    }
</script>

<style scoped>

</style>