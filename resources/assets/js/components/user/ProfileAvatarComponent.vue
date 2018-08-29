<template>
    <div class="profile-picture-area">
        <img class="profile-picture" @click="changeImage" :src="avatarImage" width="250px" height="250px">
        <file-upload :endpoint="'/upload/' + userId" @file-uploaded="fileUploaded" v-show="edit"></file-upload>
        <h4 class="text-md-center">Level:</h4>
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