<template>
<div>
    <div class="profile">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
                <profile-avatar :image="user.image" :user-id="user.id"></profile-avatar>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <h1 class="profile__name">{{user.name}}</h1>
                <div class="profile__role">
                        <span>Junior UI designer</span><i class="la la-angle-double-right hidden-xs"></i><i class="la la-angle-double-down hidden-lg hidden-md hidden-sm"></i><span
                            class="profile__role--current">UX Arhitekt</span><i class="la la-angle-double-right hidden-xs"></i><i class="la la-angle-double-down hidden-lg hidden-md hidden-sm"></i><span>Team lead</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-4">
            <h3 class="profile__subtitle">Profile</h3>
            <div class="profile__details">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="profile__details--title" >Department: </div>
                    </div>
                    <div class="col-xs-9">
                        <div class="profile__details--info"
                             @click="changeText('department')"
                        >
                            {{user.department}}
                        </div>
                        <user-department
                                v-show="isadmin && editdepartment"
                                :userid="user.id"
                                @select-updated="personalDataUpdated('department', $event)"
                        ></user-department>
                        <user-team
                                v-show="isadmin && editdepartment"
                                :userid="user.id"
                                @select-updated="personalDataUpdated('team', $event)"
                        ></user-team>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <div class="profile__details--title"  >Phone:</div>
                    </div>
                    <div class="col-xs-9">
                        <editable-input-component
                                v-if="editphone"
                                :endpoint="'/user/'+ user.id + '/update/phone'"
                                :data="user.phone"
                                ref="phone"
                                element-name="PHONE"
                                @input-updated="personalDataUpdated('phone', $event)"
                                @canceled="hideInput('phone', $event)"
                        ></editable-input-component>
                        <div class="profile__details--info" v-if="editphone === false"
                              @dblclick="changeText('phone')">{{user.phone}}

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3">
                        <div class="profile__details--title">Email:</div>
                    </div>
                    <div class="col-xs-9">
                        <editable-input-component
                                v-show="isadmin && editemail"
                                :endpoint="'/user/' + user.id + '/update/email'"
                                ref="email"
                                :data="user.email"
                                element-name="EMAIL"
                                @input-updated="personalDataUpdated('email', $event)"
                                @canceled="hideInput('email', $event)"
                        ></editable-input-component>

                        <div class="profile__details--info" v-if="editemail === false"
                             @dblclick="changeText('email')">{{user.email}}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <div class="profile__details--title">Skype:</div>
                    </div>
                    <div class="col-xs-9">
                        <editable-input-component
                                v-if="editskype"
                                :endpoint="'/user/' + user.id + '/update/skype'"
                                :data="user.skype"
                                element-name="SKYPE"
                                @input-updated="personalDataUpdated('skype', $event)"
                                @canceled="hideInput('skype', $event)"
                        ></editable-input-component>
                        <div class="profile__details--info" v-if="editskype === false"
                             @dblclick="changeText('skype')">{{user.skype}}</div>
                    </div>
                </div>
                <div class="profile__details--pills">
                    <div class="profile__pill"><i class="la la-birthday-cake"></i> {{user.birthday}}</div>
                    <div class="profile__pill"><img alt="" src="" class="profile__pill--logo"> 3y4m</div>
                </div>
                <div class="profile__details--text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida
                        dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor. Sociis natoque
                        penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra
                        vulputate, felis tellus mollis orci, sed rhoncus pronin sapien nunc accuan eget.</p>
                </div>
            </div>
            <user-strenght :canedit="canedit" :userid="user.id" ></user-strenght>
            <user-children :canedit="canedit" :userid="user.id"></user-children>
            <user-hobbies :canedit="canedit" :userid="user.id"></user-hobbies>
            <user-badge :canedit="canedit" :userid="user.id"></user-badge>
        </div>
        <div class="col-sm-12 col-md-8">
            <user-role :canedit="canedit" :userid="user.id"></user-role>
            <user-skill :canedit="canedit" :userid="user.id"></user-skill>
            <user-project :canedit="canedit" :userid="user.id"></user-project>
            <user-training :canedit="canedit" :userid="user.id"></user-training>
        </div>
    </div>
</div>
</template>


<script>
    import EditableInputComponent from '../EditableInputComponent'
    import UserHobby from "./UserHobby";
    import UserBadge from "./UserBadge";

    export default {
        name: "ProfileView",
        components: {UserBadge, UserHobby, EditableInputComponent},
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
</style>