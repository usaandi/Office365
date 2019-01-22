<template>
    <div>
        <div class="profile__avatar p-50">
            <img class="profile__avatar--image" @click="changeImage" :src="avatarImage" alt="">
        </div>
        <div class="profile__avatar--level">
            <div class="profile__pill profile__pill--small">LVL Black Belt</div>
        </div>
        <file-upload @close="closeEdit($event)" v-show="edit" :endpoint="'/upload/' + userId"
                     @file-uploaded="fileUploaded"></file-upload>
    </div>
</template>

<script>
    import Vue from 'vue';

    export default {
        name: "ProfileAvatarComponent",
        props: ['image', 'userId'],
        data() {
            return {
                avatarImage: null,
                edit: false
            }
        },
        mounted() {
            this.avatarImage = this.image;
        },
        methods: {
            closeEdit(value) {
                if (this.edit !== value) {
                    this.edit = value;
                }
            },
            changeImage() {
                if (authUser.id === this.userId || Vue.$isAdmin()) {
                    if (this.edit) {
                        this.edit = false;
                    } else {
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

</style>