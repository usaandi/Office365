<template>
<div>
    <div class="profile__avatar p-85">
        <img class="profile__avatar--image" @click="changeImage" :src="avatarImage" alt="">
        <file-upload :endpoint="'/upload/' + userId" @file-uploaded="fileUploaded" v-show="edit"></file-upload>
    </div>
    <div class="profile__avatar--level">
        <div class="profile__pill profile__pill--small">LVL Black Belt</div>
    </div>
</div>
</template>

<script>
    export default {
        name: "ProfileAvatarComponent",
        props: ['image', 'userId'],
        data(){
            return{
                avatarImage: null,
                edit: false
            }
        },
        mounted() {
            console.log(this.image);
          this.avatarImage = this.image;
        },
        methods: {
            changeImage() {
                if (authUser.id === this.userId || Vue.$isAdmin()) {
                    if (this.edit) {
                        this.edit = false;
                    }
                    else {
                        this.edit = true;
                    }
                }
            },
            fileUploaded(response) {
                if (response.status === 200) {
                    this.edit = false;
                    this.avatarImage = response.data;
                }
            }
        }

    }
</script>

<style scoped>
    .profile-picture{
        border-radius: 50%;
    }
</style>