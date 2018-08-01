<template>
    <div class="list-wrapper">
        <div v-for="department in departments" class="profiles-view align-center">
            <department-list-view v-bind:department="department"></department-list-view>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['departments'],
        name: "DepartmentListComponent.vue"
    }
</script>

<style scoped>
    .list-wrapper {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        flex-flow: row wrap;
        margin: -2rem;
        justify-content: space-around;


    }
    .profiles-view {
        border: 1px solid #e1e1e1;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        flex: 1 0 33%;
        margin: 1rem;
        width:auto;
        height: 100px;

    }
    .align-center{

        text-align: center;
    }
    /*@media screen and (min-width: 768px) {*/
        /*.list-wrapper {*/
            /*flex: 1 0 50%;*/


        /*}*/
    /*}*/
    /*@media screen and (min-width: 424px) {*/
        /*.list-wrapper {*/
            /*width:100%;*/
            /*display: flex;*/
            /*flex-wrap: wrap;*/

        /*}*/
    /*}*/
    /*@media screen and (min-width: 1039px) {*/
        /*.profiles-view {*/
            /*flex: 1 0 100%;*/
            /*height: 100px;*/
        /*}*/
        /*.list-wrapper {*/
            /*flex: 1 0 50%;*/
            /*display: flex;*/
            /*flex-wrap: wrap;*/

        /*}*/
    /*}*/
</style>