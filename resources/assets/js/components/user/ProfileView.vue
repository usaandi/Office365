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
                        <div class="profile__details--info" v-if="editphone === false"
                              @click="changeText('phone')">{{user.phone}}
                            <editable-input-component
                                    v-if="editphone"
                                    :endpoint="'/user/'+ user.id + '/update/phone'"
                                    :data="user.phone"
                                    ref="phone"
                                    element-name="PHONE"
                                    @input-updated="personalDataUpdated('phone', $event)"
                                    @canceled="hideInput('phone', $event)"
                            ></editable-input-component>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3">
                        <div class="profile__details--title">Email:</div>
                    </div>
                    <div class="col-xs-9">
                        <div class="profile__details--info">{{user.email}}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <div class="profile__details--title">Skype:</div>
                    </div>
                    <div class="col-xs-9">
                        <div class="profile__details--info">{{user.skype}}</div>
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
            <h3 class="profile__subtitle">Strenghts</h3>
            <div class="profile__strenghts">
                <div class="profile__strenght">
                    <div class="profile__strenght--info">
                        <i class="la la-lightbulb-o"></i> IDEATION
                    </div>
                    <div class="progress m-progress--custom">
                        <div class="progress-bar m--bg-info" role="progressbar" style="width: 90%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="profile__strenght">
                    <div class="profile__strenght--info">
                        <i class="la la-bullhorn"></i> COMMUNICATION
                    </div>
                    <div class="progress m-progress--custom">
                        <div class="progress-bar m--bg-info" role="progressbar" style="width: 85%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="profile__strenght">
                    <div class="profile__strenght--info">
                        <i class="la la-bullhorn"></i> WOO
                    </div>
                    <div class="progress m-progress--custom">
                        <div class="progress-bar m--bg-info" role="progressbar" style="width: 75%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="profile__strenght">
                    <div class="profile__strenght--info">
                        <i class="la la-crosshairs"></i> STRATEGIC
                    </div>
                    <div class="progress m-progress--custom">
                        <div class="progress-bar m--bg-info" role="progressbar" style="width: 70%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="profile__strenght">
                    <div class="profile__strenght--info">
                        <i class="la la-flask"></i> FUTURISTIC
                    </div>
                    <div class="progress m-progress--custom">
                        <div class="progress-bar m--bg-info" role="progressbar" style="width: 60%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="profile__strenght">
                    <div class="profile__strenght--info">
                        <i class="la la-flask"></i> Input
                    </div>
                    <div class="progress m-progress--custom">
                        <div class="progress-bar m--bg-info" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

            </div>

            <user-children :canedit="canedit" :userid="user.id"></user-children>
            <user-hobbies :canedit="canedit" :userid="user.id"></user-hobbies>

            <h3 class="profile__subtitle">Badges</h3>
            <div class="profile__badges row">
                <div class="profile__badge">
                    <div class="profile__badge--circle">
                        <div class="profile__badge--icon">
                            <i class="la la-trophy"></i>
                        </div>
                    </div>
                    <div class="profile__badge--title">Employee of the month</div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8">
            <h3 class="profile__subtitle">Role</h3>
            <div class="profile__text">
                <p>Coordinate with designers and developers to develop various new products and features along with various
                    interactive designs within required timeframe.</p>
                <p>Develop new business initiatives in coordination with UE team and design various methodologies and practices
                    for innovative interactive technologies and perform quality assurance and browser computability tests.</p>
                <p>Design style sheets for website and assist application programmers in effective implementation and ensure
                    all work according to scripting code with help of various technologies.</p>
                <p>Collaborate with designers and application developer to develop various customized websites.</p>
                <p>Prepare all production documents on Photoshop and translate same into HTML templates with help of developers
                    and designers and facilitate to introduce new features into same.</p>
            </div>
            <h3 class="profile__subtitle">Skills</h3>
                <div class="profile__skills row">
                    <div class="col-sm-6">
                        <div class="profile__skill clearfix">
                            <div class="profile__skill--title">HTML</div>
                            <div class="profile__skill--progress">
                                <div class="progress m-progress--sm">
                                    <div role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar m--bg-info" style="width: 84%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="profile__skill clearfix">
                            <div class="profile__skill--title">Drupal 8
                            </div>
                            <div class="profile__skill--progress">
                                <div class="progress m-progress--sm">
                                    <div role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar m--bg-info" style="width: 70%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    </div>
</div>

<!--

                    <p v-show="editdepartment === false"
                       class="" @dblclick="changeText('department')"
                    ><b>DEPARTMENT:</b>{{ user.department }}</p>


                    <p v-show="editdepartment === false" class="text"
                    @dbclick="changeText('team')"
                    ><b>TEAM:</b>{{user.team}}</p>


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

                    <h2 class="text-color-cyan">HOBBIES</h2>
                    <user-hobbies :canedit="canedit" :userid="user.id"></user-hobbies>
                    <h2 class="text-color-cyan">BADGES</h2>

                <div class=" col-md-9">
                    <h1 class="text-font-size text-md-center text-font">{{user.name}}</h1>
                    <h2 class="text-color-cyan">ROLE</h2>
                    <user-role :canedit="canedit" :userid="user.id"></user-role>
                    <h2 class="text-color-cyan">SKILLS</h2>
                    <h2 class="text-color-cyan">PROJECTS</h2>
                    <h2 class="text-color-cyan">TRAINING</h2>
                </div>-->
</div>
</template>


<script>
    import EditableInputComponent from '../EditableInputComponent'
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
                console.log('reached here');
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