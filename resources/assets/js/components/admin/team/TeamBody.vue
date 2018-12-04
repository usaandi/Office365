<template>
    <tr>
        <td><span>{{team.id}}</span></td>
        <td><span>{{team.team_name}}</span></td>
        <td><span class="btn btn-success" @click="edit" > Edit Team</span></td>
        <td>
            <span><button type="button" @click="deleteRequest"  class="btn btn-danger"
            >Delete Team</button></span>
        </td>
        <td>
            <span><span   class="btn btn-success"
            >Manage </span></span>
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
        methods:{
            deleteRequest() {
                this.$emit('deleteRequest', this.selectedTeam);
                this.$emit('index', this.index);
            },
            edit() {
                this.$emit('update', this.selectedTeam);
                this.$emit('index', this.index);

            }
        }
    }
</script>

<style scoped>

</style>