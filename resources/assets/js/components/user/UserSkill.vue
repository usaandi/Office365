<template>
<div>
    <h3 class="profile__subtitle">Skills</h3>
    <div class="profile__skills row">
        <div class="col-sm-6">
            <div class="profile__skill clearfix">
                <div class="profile__skill--title">HTML</div>
                <div class="profile__skill--progress">
                    <div class="progress m-progress--sm">
                        <div role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar m--bg-info" style="width: 84%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="profile__skill clearfix">
                <div class="profile__skill--title">Drupal 8
                </div>
                <div class="profile__skill--progress">
                    <div class="progress m-progress--sm">
                        <div role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar m--bg-info" style="width: 70%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "UserSkill",
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