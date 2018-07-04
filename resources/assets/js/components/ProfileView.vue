<template>
    <div class="user-profile">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <profile-avatar :image="user.image" :user-id="user.id"></profile-avatar>
                    <h2 class="text-color-cyan">PROFILE</h2>
                    <p class="text"><b>TEAM:</b>{{user.team}}</p>
                    <p class="text" ><b>PHONE:</b>{{user.phoneN}}</p>
                    <p class="text"><b>EMAIL:</b>{{user.email}}</p>
                    <p  class="text" v-on:dblclick="user.edit=true"><b>SKYPE:</b>{{user.skype}}</p>
                    <h2 class="text-color-cyan" >STRENGTHS</h2>
                    <h2 class="text-color-cyan" >CHILDREN</h2>
                    <h2 class="text-color-cyan">HOBBIES</h2>
                    <h2 class="text-color-cyan">BADGES</h2>
                </div>
                <div class=" col-md-9">
                    <h1 class="text-font-size text-md-center text-font">{{user.name}}</h1>
                    <h3 class="text-color-cyan">ROLE</h3>
                    <p class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley <br>of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged.
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software
                        like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    <h2 class="text-color-cyan">SKILLS</h2>
                    <h2 class="text-color-cyan">PROJECTS</h2>
                    <h2 class="text-color-cyan">TRAINING</h2>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProfileView",
        props: ['user', 'image'],
        data(){
            return{
                skype: '',
                edit: false,
                edittext:''
            }
        },
        mounted() {
            this.avatarImage = this.image;
        },

        methods: {
            changeText() {
                if (authUser.id === this.userId || Vue.$isAdmin()) {
                    if (this.edit) {
                        this.edit = false;
                    }
                    else {
                        this.edit = true;
                    }
                }
            }
        }
    }

</script>

<style scoped>
    /*div{*/
        /*border: 2px solid black;*/
    /*}*/
    .text-color-cyan{
        color: #00adee;
    }
    .text-font-size{
        font-size: 60px;
    }
    .profile-picture{
        border-radius: 50%;
    }
</style>