<template>
    <div>
        <h3 class="profile__subtitle">Training</h3>
        <div class="profile__article clearfix">
            <a href="#">
                <h4 class="profile__article--title">SEB migration to Drupal 8</h4>
            </a>
            <div class="profile__article--header">
                <span class="profile__article--date">2018 May</span>
            </div>
            <div class="profile__text">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida
                    dolor sit amet lacus accumsan et viverra justo commodo.</p>
            </div>
        </div>
        <div class="load-more">
            <a href="#" class="btn btn-outline-accent m-btn m-btn--icon m-btn--pill">
                    <span>
                  <i class="la la-refresh"></i>
                  <span>Load more</span>
                    </span>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserTraining",
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