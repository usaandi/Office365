<template>
    <div>
        <h3 class="profile__subtitle">Strenghts</h3>
        <div class="profile__strenghts">
            <div class="profile__strenght">
                <div class="profile__strenght--info">
                    <i class="la la-lightbulb-o"></i> IDEATION
                </div>
                <div class="progress m-progress--custom">
                    <div class="progress-bar m--bg-info" role="progressbar" style="width: 90%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="profile__strenght">
                <div class="profile__strenght--info">
                    <i class="la la-bullhorn"></i> COMMUNICATION
                </div>
                <div class="progress m-progress--custom">
                    <div class="progress-bar m--bg-info" role="progressbar" style="width: 85%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="profile__strenght">
                <div class="profile__strenght--info">
                    <i class="la la-bullhorn"></i> WOO
                </div>
                <div class="progress m-progress--custom">
                    <div class="progress-bar m--bg-info" role="progressbar" style="width: 75%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="profile__strenght">
                <div class="profile__strenght--info">
                    <i class="la la-crosshairs"></i> STRATEGIC
                </div>
                <div class="progress m-progress--custom">
                    <div class="progress-bar m--bg-info" role="progressbar" style="width: 70%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="profile__strenght">
                <div class="profile__strenght--info">
                    <i class="la la-flask"></i> FUTURISTIC
                </div>
                <div class="progress m-progress--custom">
                    <div class="progress-bar m--bg-info" role="progressbar" style="width: 60%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="profile__strenght">
                <div class="profile__strenght--info">
                    <i class="la la-flask"></i> Input
                </div>
                <div class="progress m-progress--custom">
                    <div class="progress-bar m--bg-info" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "UserStrenght",
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