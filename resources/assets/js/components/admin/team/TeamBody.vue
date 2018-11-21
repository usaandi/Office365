<template>
    <tr>
        <td><span>{{team.id}}</span></td>
        <td><span>{{team.team_name}}</span></td>
        <td><span class="btn btn-success" > Edit Team</span></td>
        <td>
            <span><button type="button"  class="btn btn-danger"
            >Delete Team</button></span>
        </td>
    </tr>
</template>

<script>
    export default {
        props:['team','index'],
        name: "TeamBody",
        data() {
            return {
                selectedTeam: this.team,
            }
        },
        watch: {
            team(value) {
                this.selectedTeam = value;
            }
        },
    }
</script>

<style scoped>

</style>