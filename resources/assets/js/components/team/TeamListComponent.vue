<template>
<div>
    <div>
        <div class="col-md-10 boxed">
            <h4>Teams List</h4>
              <div v-for="(team, index) in teams" :key="team.id" :data-id="team.id" id="main">
                  <div>{{team.team}}</div>
              </div>
        </div> <!-- end col-md-10 -->
    </div>

        <div class="col-md-2">
            <h4>Users List</h4>
            <draggable class="list-group min-height" :list="users" :options="{animation:200}" :element="'ul'" @add="">
                <li class="list-group-item" v-for="(user, index) in users" :key="user.id" :data-id="user.id">
                    <div class=""><strong>{{ user.name }}</strong></div>
                </li>
            </draggable>
        </div> <!-- end col-md-2 -->
</div>
</template>

<script>

    import draggable from 'vuedraggable';
    import axios from 'axios';

    export default {
        components: {
          draggable,
        },
        props: ['departmentid'],
        name: "TeamListComponent",
        data(){
            return{
                id:'',
                users: [],
                teams: [],
            }
        },
        mounted() {
            this.id = this.departmentid;
            this.fetchDataUsers();
            this.fetchDataTeams();

        },

        methods:{
            fetchDataTeams: function(){

                axios.get('/department/'+ this.id + '/team')
                    .then(response=>{
                        /*console.log(response.data);*/
                     this.teams=response.data;

                    })

            },

            fetchDataUsers: function () {
                axios.get('/department/' + this.id + '/user')
                    .then(response => {
                        this.users = response.data;
                    });
            },
        }
    }
</script>

<style scoped>

    .boxed{

    }
    #main {
        margin: 2rem;
        width: 50px;

        height: 50px;
}

</style>