<template>
<div class="overlay-wrapper">
    <h3 class="profile__subtitle">Badges</h3>
    <div class="profile__badges row">
        <div class="profile__badge">
            <div class="profile__badge--circle">
                <div class="profile__badge--icon">
                    <i class="la la-trophy"></i>
                </div>
            </div>
            <div class="profile__badge--title">Employee of the month</div>
        </div>
        <div class="profile__badge">
            <div class="profile__badge--circle">
                <div class="profile__badge--icon">
                    <i class="la la-trophy"></i>
                </div>
            </div>
            <div class="profile__badge--title">Employee of </div>
        </div>
        <div class="profile__badge">
            <div class="profile__badge--circle">
                <div class="profile__badge--icon">
                    <i class="la la-trophy"></i>
                </div>
            </div>
            <div class="profile__badge--title">Employee</div>
        </div>
        <div class="profile__badge">
            <div class="profile__badge--circle">
                <div class="profile__badge--icon">
                    <i class="la la-trophy"></i>
                </div>
            </div>
            <div class="profile__badge--title">Emp</div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "UserBadge",
        props:['userid'],
        data(){
            return {

                userId:'',

            }
        },
        mounted(){
            this.userId=this.userid;

        }
    }
</script>

<style scoped>

</style>