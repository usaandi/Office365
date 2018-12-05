<template>
    <div>
        <p>hello world . {{id}}</p>
    </div>
</template>

<script>
    export default {
        props: {
            id: {
                required: true
            },
            teamInfo: {}

        },
        name: "TeamModeratorView",
        data() {
            return {

            }
        }

    }
</script>

<style scoped>

</style>