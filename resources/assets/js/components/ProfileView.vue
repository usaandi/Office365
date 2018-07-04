<template>
    <div class="user-profile">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <profile-avatar :image="user.image"></profile-avatar>
                    <h3 class="text-color-cyan">PROFILE</h3>
                    <p class=" text"> <b>TEAM:</b>{{user.team}}</p>
                    <p class=" text"> <b>PHONE:</b>{{user.phoneN}}</p>
                    <p class=" text"> <b>EMAIL:</b>{{user.email}}</p>
                    <p class=" text"> <b>SKYPE:</b>{{user.skype}}</p>
                    <h2 class="text-color-cyan" >Strengths</h2>
                    <h2 class="text-color-cyan" >Children</h2>
                    <h2 class="text-color-cyan">Hobbies</h2>
                    <h2 class="text-color-cyan">Badges</h2>
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
                    <h3 class="text-color-cyan">SKILLS</h3>
                    <h3 class="text-color-cyan">PROJECTS</h3>
                    <h3 class="text-color-cyan">TRAINING</h3>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProfileView",
        props: ['user', 'image'],

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