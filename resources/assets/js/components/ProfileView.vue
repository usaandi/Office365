<template>


    <div class="user-profile">

        <!--Begin right side of the profile-->
        <div class="profile-info-right text-md-center text-font">
            <h1 class="text-font-size">{{user.name}}</h1>
        </div>
        <div class="profile-info-right" >
            <h3 class="text-color-cyan">ROLE</h3>
            <p class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley <br>of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged.
                It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
        <div class="profile-info-right" >
            <h3 class="text-color-cyan">SKILLS</h3>
        </div>
        <div class="profile-info-right" >
            <h3 class="text-color-cyan">PROJECTS</h3>
        </div>
        <div class="profile-info-right" >
            <h3 class="text-color-cyan">TRAINING</h3>
        </div>
        <!--End right side of the profile-->

        <!--Begin left side of the profile-->
        <div class="profile-picture-area">
            <img class="profile-picture" src="https://www.w3schools.com/w3images/avatar2.png"width="250px" height="250px">
            <h4 class="text-md-center">Level:</h4>
        </div>

        <div class="text-md-left text profile-info-left">
            <h3 class="text-color-cyan">PROFILE</h3>
            <p class=" text"> <b>TEAM:</b>{{user.team}}</p>
            <p class=" text"> <b>PHONE:</b>{{user.phoneN}}</p>
            <p class=" text"> <b>EMAIL:</b>{{user.email}}</p>
            <p class=" text"> <b>SKYPE:</b>{{user.skype}}</p>
        </div>
        <div class="profile-info-left text" >
            <h2 class="text-color-cyan" >Strengths</h2>
        </div>
        <div class="profile-info-left">
            <h2 class="text-color-cyan" >Children</h2>
        </div>
        <div class="profile-info-left">
            <h2 class="text-color-cyan">Hobbies</h2>
        </div>
        <div class="profile-info-left">
            <h2 class="text-color-cyan">Badges</h2>
        </div>
        <!--End left side of the profile-->
    </div>
</template>

<script>
    export default {
        name: "ProfileView",
        props: ['user'],
    }
</script>

<style scoped>

    div{
        /*border: 2px solid black;*/
    }

    .text-color-cyan{
        color: #00adee;
    }
    .text-font-size{
        font-size: 60px;
    }
    .text {
        text-align: justify;
        font-size: 20px;
        word-wrap: break-word;

    }
    .user-profile{
        width: 90%;
        position: relative;
        display: block;

    }
    .profile-info-left{
        width: 35%;
        margin: 20px;
    }

    .profile-picture-area{
        width:265px;
        margin:20px;
    }
    .profile-picture{
        border-radius: 50%;
        margin: 5px;
    }
    .profile-info-right{
        width: 50%;
        margin: 20px;
        float: right;
        clear: both;
        position: relative;
    }

</style>