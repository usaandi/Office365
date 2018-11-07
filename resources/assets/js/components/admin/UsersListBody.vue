<template>
    <tr>
        <td><span>{{propUser.id}}</span></td>
        <td><span>{{propUser.name}}</span></td>
        <td><span ><a :href="'/user/' + propUser.id +'/update'" class="btn btn-success" >Edit User</a></span></td>
        <td>
            <span><button @click="deleteUser(index)" type="button" class="btn btn-danger"
                          >Delete User</button></span>
        </td>
    </tr>
</template>

<script>
    export default {
        props: {
            'index':{required:true},
            'propUser': {type: Object, required:true},},
        name: "UserListBody",
        methods:{
            deleteUser(objectIndex){

                this.$emit('deleteUser',objectIndex);
            }
        }

    }
</script>

<style scoped>

</style>