<template>
    <div>
        <p>hello world . {{teamUsers.team_name}}</p>
    </div>
</template>

<script>
    export default {
        props: {
            teamId: {
                required: true
            },
            teamInfo: {
                required:true
            }

        },
        name: "TeamModeratorView",
        data() {
            return {
                teamUsers:this.teamInfo,

            }
        }

    }
</script>

<style scoped>

</style>