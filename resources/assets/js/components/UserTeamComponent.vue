<template>
    <div>
        <v-select  taggable push-tags
                   label="team_name"
                   :options="teams"
                   @option:created="updateOptions"
                   @input="selectedValue"
                   @keydown.native.enter="submit()"
        ></v-select>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        props: ['userid','canedit'],
    data(){
        return{

            id:'',
            teams:[],
            team:'',
            teamId:'',

        }
    },

    mounted(){
        this.id=this.userid;
        this.fetchData();
    },

    methods:{

        fetchData: function () {
            axios.get('/teamInfo')
                .then(response=>{
                    this.teams=response.data;
                });
        },

        submit: function(){
            let vm =this;
            axios.post('/user/'+ this.id + '/team',{data: this.team.team_name})
                .then(response => {
                    vm.$emit('select-updated', vm.team.team_name);
                    vm.team = '';
                });

            },

        updateOptions(newOption) {
            this.team = newOption;

        },

        selectedValue(value) {
            this.team = value;
            this.teamId = this.team.id;
            this.submit();
        }
        },


    }
</script>

<style scoped>

</style>