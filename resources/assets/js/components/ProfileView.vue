<template>
    <div class="user-profile">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <profile-avatar :image="user.image" :user-id="user.id"></profile-avatar>
                    <h2 class="text-color-cyan">PROFILE</h2>

                    <p v-show="editdepartment === false"
                       class="text" @dblclick="changeText('department')"
                    ><b>DEPARTMENT:</b>{{ user.department }}</p>
                    <user-department
                            v-show="isadmin && editdepartment"
                            :userid="user.id"
                            @select-updated="personalDataUpdated('department', $event)"
                    ></user-department>

                    <p v-show="editdepartment === false" class="text"
                    @dbclick="changeText('team')"
                    ><b>TEAM:</b>{{user.team}}</p>
                    <user-team
                            v-show="isadmin && editdepartment"
                            :userid="user.id"
                            @select-updated="personalDataUpdated('team', $event)"
                    ></user-team>

                    <p v-if="editphone === false"
                       class="text" @dblclick="changeText('phone')"
                    ><b>PHONE:</b>{{ user.phone }}</p>
                    <editable-input-component
                            v-if="editphone"
                            :endpoint="'/user/'+ user.id + '/update/phone'"
                            :data="user.phone"
                            ref="phone"
                            element-name="PHONE"
                            @input-updated="personalDataUpdated('phone', $event)"
                            @canceled="hideInput('phone', $event)"
                    ></editable-input-component>

                    <p v-show="editemail === false"
                       class="text" @dblclick="changeText('email')"
                    ><b>EMAIL:</b>{{ user.email }}</p>
                    <editable-input-component
                            v-show="isadmin && editemail"
                            :endpoint="'/user/' + user.id + '/update/email'"
                            ref="email"
                            :data="user.email"
                            element-name="EMAIL"
                            @input-updated="personalDataUpdated('email', $event)"
                            @canceled="hideInput('email', $event)"
                    ></editable-input-component>

                    <p v-show="editskype === false"
                       class="text" @dblclick="changeText('skype')"
                    ><b>SKYPE:</b>{{ user.skype }}</p>
                    <editable-input-component
                            v-if="editskype"
                            :endpoint="'/user/' + user.id + '/update/skype'"
                            :data="user.skype"
                            element-name="SKYPE"
                            @input-updated="personalDataUpdated('skype', $event)"
                            @canceled="hideInput('skype', $event)"
                    ></editable-input-component>

                    <h2 class="text-color-cyan" >STRENGTHS</h2>
                    <h2 class="text-color-cyan" >CHILDREN</h2>
                    <user-children :canedit="canedit" :userid="user.id"></user-children>
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
                canedit: false,
                editdepartment: false,
                editteam: false,
                editphone: false,
                editemail: false,
                editskype: false
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
            changeText(type) {
                if (this.canedit) {
                    const name = 'edit' + type;
                    this[name] = true;
                }
            },
            personalDataUpdated(type, data) {
                this.user[type] = data;
                this.hideInput(type);
            },
            hideInput(type) {
                const name = 'edit' + type;
                this[name] = false;
            }
        }
    }

</script>

<style scoped>

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