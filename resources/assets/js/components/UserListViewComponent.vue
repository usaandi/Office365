<template>
        <div class="text">
            <a v-bind:href="'/user/' + user.id"><img :src="user.image" width="100px" height="100px"></a>
            <h4 class="name">{{ user.name }}</h4>
            <h4 class="team-1" ><small>{{user.team}} | </small></h4>
            <p><i class="fa fa-envelope style-green "></i>{{user.email}}</p>
            <p class=""><i class="fa fa-phone style-green"> </i>{{user.phoneN}} </p>
        </div>
</template>

<script>
export default {

    props: ['user'],
}

</script>

<style scoped>
    .name{
        font-size: 28px;
    }
    p{
        font-size:18px;
    }
    img {
        border-radius: 50%;
        float:left;
        margin-right: 15px;
        margin-bottom: 5px;
    }
    .style-green{
        font-size:14px;
        color: #98ff6c;
    }
    .text {
        text-align: justify;
        margin-top: 10px;
        margin-left: 10px;
        line-height:3px;
    }
</style>