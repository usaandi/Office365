<template>
<div>
    <div v-if="!users">Loading please wait...</div>
    <div v-else>
        <div v-for="user in users">
            {{user.name}}
        </div>
    </div>
</div>
</template>



<script>
    export default {
        props: ['users'],


        mounted() {

            console.log(this.users);

        },

    }
</script>


<style scoped>

</style>