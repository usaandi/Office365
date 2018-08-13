<template>
    <div class="user-profile">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <profile-avatar :image="user.image" :user-id="user.id"></profile-avatar>
                    <h2 class="text-color-cyan">PROFILE</h2>

                    <p v-show="canedit === false" class="text" @dblclick="changeText"><b>TEAM:</b>{{ user.team }}</p>
                    <editable-input-component v-show="canedit" :endpoint="'/user/' + user.id + '/update/team'" :data="user.team" element-name="TEAM"></editable-input-component>

                    <p v-show="canedit === false" class="text" @dblclick="changeText"><b>PHONE:</b>{{ user.phoneN }}</p>
                    <editable-input-component v-show="canedit" :endpoint="'/user/'+ user.id + '/update/phone'" :data="user.phoneN" element-name="PHONE"></editable-input-component>

                    <p v-show="isadmin === false" class="text" @dblclick="changeText"><b>EMAIL:</b>{{ user.email }}</p>
                    <editable-input-component v-show="isadmin" :endpoint="'/user/' + user.id + '/update/email'" :data="user.email" element-name="EMAIL"></editable-input-component>

                    <p v-show="canedit === false" class="text" @dblclick="changeText"><b>SKYPE:</b>{{ user.skype }}</p>
                    <editable-input-component v-show="canedit" :endpoint="'/user/' + user.id + '/update/skype'" :data="user.skype" element-name="SKYPE"></editable-input-component>

                    <h2 class="text-color-cyan" >STRENGTHS</h2>
                    <h2 class="text-color-cyan" >CHILDREN</h2>
                    <user-children :userid="user.id"></user-children>
                    <h2 class="text-color-cyan">HOBBIES</h2>
                    <user-hobbies :canedit="canedit" :userid="user.id"></user-hobbies>
                    <h2 class="text-color-cyan">BADGES</h2>
                </div>
                <div class=" col-md-9">
                    <h1 class="text-font-size text-md-center text-font">{{user.name}}</h1>
                    <h2 class="text-color-cyan">ROLE</h2>
                    <user-role :canedit="canedit" :userid="user.id"></user-role>
                    <h2 class="text-color-cyan">SKILLS</h2>
                    <h2 class="text-color-cyan">PROJECTS</h2>
                    <h2 class="text-color-cyan">TRAINING</h2>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import EditableInputComponent from './EditableInputComponent'
    import UserHobby from "./UserHobby";

    export default {
        name: "ProfileView",
        components: {UserHobby, EditableInputComponent},
        props: ['user', 'image'],
        data: function(){
            return{
                edit:false,
                userdata: '',
                text: '',
                canedit: false
            }
        },
        computed: {
            isadmin: function () {
                return Vue.$isAdmin()
            }
        },
        mounted() {
            this.userdata = this.user;
            if (authUser.id === this.user.id || this.isadmin) {
                this.canedit = true;
            }
        },

        methods: {
            changeText: function() {
                if (this.canedit) {
                    if (this.edit) {
                        this.edit = false;
                    }
                    else {
                        this.edit = true;
                    }
                }
            },
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