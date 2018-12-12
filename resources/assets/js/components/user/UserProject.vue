<template>
    <div class="overlay-wrapper">
        <h3 class="profile__subtitle">Projects</h3>
        <div class="profile__article clearfix">
            <a href="#">
                <h4 class="profile__article--title">SEB migration to Drupal 8</h4>
            </a>
            <div class="profile__article--header">
                <span class="profile__article--date">2018 May</span>
                <span class="profile__article--link"><a href="#">www.seb.ee</a></span>
            </div>
            <div class="profile__text">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida
                    dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque
                    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra
                    vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>
            </div>
            <div class="profile__article--footer">
                <ul class="profile__article--tags clearfix">
                    <li><a href="#">#Drupal8</a></li>
                    <li><a href="#">#bank</a></li>
                    <li><a href="#">#banklinks</a></li>
                    <li><a href="#">#bootstrap4</a></li>
                </ul>
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
        name: "UserProject",
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