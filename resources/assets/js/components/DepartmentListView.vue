<template>
    <div>
        <a v-bind:href="'/department/' + department.id">
         <h1 class="align-center black-color">{{department.department_name}}</h1></a>
    </div>
</template>

<script>
    export default {

        props:['department'],
        name: "DepartmentListView"
    }
</script>

<style scoped>
    .align-center{

    }
    .black-color{
        color:black;
    }
    a:link {
        text-decoration: none;
    }

    a:visited {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    a:active {
        text-decoration: none;
    }
</style>