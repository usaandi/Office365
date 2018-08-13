<template>
    <div>
        <department-list-view>

        </department-list-view>
        <department-user-list-view></department-user-list-view>
    </div>
</template>

<script>
    export default {

        name: "DepartmentUserList",
        props: ['users','departments'],
        data(){
            return {

            }
        }
    }
</script>

<style scoped>

</style>