<template>
<div>
        <div v-for="user in users">
            <user-list-view v-bind:user="user"></user-list-view>
        </div>
</div>
</template>

<script>

    export default {
        props: ['users'],
        data(){
            return{
            }
        },
        mounted() {

            console.log(this.users);

        },

    }
</script>


<style scoped>


</style>