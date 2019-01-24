<template>
    <div>
        <a v-bind:href="'/user/' + user.id" class="profile-view__link"></a>
        <div class="profile-view__action">
            <a href="#" class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill">
                <i class="la la-plus"></i>
            </a>
        </div>
        <div class="profile-view__check--wrapper">
            <div class="profile-view__check">
            </div>
            <div class="profile-view__check--icon">
                <i class="la la-check"></i>
            </div>
        </div>
        <div class="profile-view__photo"><img alt="" :src="userImage"/></div>
        <div class="profile-view__content">
            <div class="profile-view__name">
                {{ user.name }}
            </div>
            <div class="profile-view__team">{{user.current_department}}</div>
            <div class="profile-view__role">{{user.current_role}}</div>
            <div class="profile-view__phone"><i class="la la-phone"></i>{{user.phone}}</div>
            <div class="profile-view__email"><i class="la la-envelope"></i>{{user.email}}</div>
        </div>


    </div>
    <!--
      <div class="text text-black-50">
          <a ><img :src="user.image" width="100px" height="100px"></a>
          <h4 class="name black-color">{{ user.name }}</h4>
          <h4 class="team-1" ><small>{{user.team}} | </small></h4>
          <p><i class="fa fa-envelope style-green "></i>{{user.email}}</p>
          <p class=""><i class="fa fa-phone style-green"> </i>{{user.phone}} </p>
      </div></a>-->
</template>

<script>
    export default {

        props: ['user'],
        data() {
            return {
                userImage: this.user['image'],
        }
        },

        mounted() {

            if (!this.userImage) {
                this.userImage = './assets/default/avatar.png';
            }
        }
    }


</script>
<style scoped>
    .remove-tag:link {
        text-decoration: none;
    }

    .remove-tag:visited {
        text-decoration: none;
    }

    .remove-tag:hover {
        text-decoration: none;
    }

    .remove-tag:active {
        text-decoration: none;
    }

</style>