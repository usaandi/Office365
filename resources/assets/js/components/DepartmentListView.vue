<template>
    <div>
        <h1 class="align-center">{{department.department_name}}</h1>
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
        justify-content: center;
        align-items: center;
    }

</style>