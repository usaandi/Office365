<template>
    <div>
        <h3 class="profile__subtitle">Role</h3>
        <div class="profile__text">
            <p v-if="description">{{description}}</p>
            <p v-else>Has no active role</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserRole",
        props:['UserRoleDescription'],

        data(){
            return{
                description:this.UserRoleDescription

            }
        },


    }
</script>

<style scoped>

</style>