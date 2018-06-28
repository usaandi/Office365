<template>
<div>
        <div v-for="user in users" class="profiles-view">
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
    .profiles-view{
        float:left;
        width: 29%;
        margin: 1%;
        padding: 1%;
        border: 1px solid #e1e1e1;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        position: relative;


    }

</style>