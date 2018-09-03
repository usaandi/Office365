<template>
<div class="user-list__wrapper">
    <div v-for="user in users" class="profile-view">
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

        },
    }
</script>
<style scoped>
    .user-list-wrapper {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        margin: -2rem;

    }
    .profiles-view {
        border: 1px solid #e1e1e1;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        flex: 1 0 100%;
        margin: 1rem;

    }

    @media screen and (min-width: 768px) {
        .profiles-view {
            flex: 1 0 50%;
        }
    }
    @media screen and (min-width: 1080px) {
        .profiles-view {
            flex: 1 0 29%;
            width: 29%;
        }
    }
</style>