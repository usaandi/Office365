<template>
    <tr>
        <td><span>{{propUser.id}}</span></td>
        <td><span>{{propUser.name}}</span></td>
        <td><span ><a :href="'/user/' + propUser.id +'/update'" class="btn btn-success" >Edit User</a></span></td>
    </tr>
</template>

<script>
    export default {
        props: {'propUser': {type: Object, required:true},},
        name: "UserListBody",

    }
</script>

<style scoped>

</style>