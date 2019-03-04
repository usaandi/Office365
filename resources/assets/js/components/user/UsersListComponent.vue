<template>
    <div>
        <div class="user-list__wrapper">
            <div v-for="user in users" class="profile-view">
                <user-list-view v-bind:user="user"></user-list-view>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['users'],
        data() {
            return {}
        },
        mounted() {


        },
    }
</script>
<style scoped>
</style>