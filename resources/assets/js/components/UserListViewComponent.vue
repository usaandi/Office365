<template>

    <div class="">

        <div class="text-md-center profiles text ">
            <img src="https://www.w3schools.com/w3images/avatar2.png" width="100px" height="100px">

            <a v-bind:href="'/user/' + user.id"></a>
            <h4>{{ user.name }}</h4>
            <p><i class="fa fa-envelope style-green "></i> {{user.email}}</p>
            <p><i class="fa fa-phone style-green"> </i>{{user.phoneN}} </p>

        </div>
    </div>

</template>

<script>
export default {

    props: ['user'],
}

</script>

<style scoped>

    .style-green{
        font-size:14px;
        color:green;
    }
    .text {
        padding-right: 10px;
        padding-top:10px;
    }
    .profiles{
        float:left;
        margin: 10px;
        width: 400px;
        height:150px;
        border: 1px solid #e1e1e1;
    }
.childcontent {

}


</style>