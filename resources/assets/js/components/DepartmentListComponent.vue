<template>
    <div class="list-wrapper">
        <div v-for="department in departments" class="profiles-view">

        </div>
    </div>
</template>

<script>
    export default {
        props: ['departments'],
        name: "departmentListComponent.vue"
    }
</script>

<style scoped>
    .list-wrapper {
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
</style>