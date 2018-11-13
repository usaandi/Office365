<template>
    <div>
        <v-select  taggable push-tags
                   v-model="selected"
                   :options="teams"
                   @option:created="updateOptions"
                   @input="selectedValue"
        ></v-select>
        <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-10">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-sm-3 col-xs-12"></div>
                    <div class="col-sm-9 col-xs-12">
                        <div class="profile-timeline__action">
                            <button @click="onClick1()" type="button"
                                    class="btn m-btn--pill btn-success m-btn m-btn--custom">Cancel
                            </button>
                            <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom"
                                    @click="submit()">Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        props: {
            'userdata': {
                required: true
            }
        },
        watch: {
            userdata: function (val) {
                this.userdata = val;
                this.selected = { label: this.userdata.team, value: this.userdata.team_id };
            }
        },
    data(){
        return{

            selected:null,
            teams: [],
            selectedTeamName:'',

        }
    },


    created(){
        this.selected = { label: this.userdata.department, value: this.userdata.department_id };
        this.fetchData();
    },
    methods:{

            onClick1(event){
                this.$emit('close','false')
            },

        fetchData: function () {
            axios.get('/teamInfo')
                .then(response=>{
                    let teamOptions = [];
                    for (let i = 0; i < response.data.length; i++){
                        const data =response.data[i];
                        teamOptions[teamOptions.length] = {
                            label: data.team_name,
                            value: data.id,
                        }
                    }
                    this.teams=teamOptions;
                });
        },

        submit: function(){
            let vm =this;
            axios.post('/user/'+ this.userdata.id + '/team',{data: this.selectedTeamName})
                .then(response => {
                    vm.$emit('select-updated', vm.selectedTeamName);
                    vm.$emit('close');
                    vm.team = '';
                });

            },

        updateOptions(newOption) {
            this.team = newOption;

        },

        selectedValue(value) {
            this.selectedTeamName = value.label;
            this.team = value;
            this.teamId = this.team.id;
        }
    },


    }
</script>

<style scoped>

</style>