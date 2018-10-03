<template>
<div>
    <div class="row">
        <div class="col-md-6">
            <b-form-group
                  id="fieldsetHorizontal"
                  horizontal
                  :label-cols="2"
                  breakpoint="md"
                  label="Career job Title"
                  label-for="inputCareerTitle">
                <b-form-input id="inputCareertTitle"
                              v-model="title"
                              type="text"
                              placeholder="Title"
                ></b-form-input>
            </b-form-group>
            <b-form-group
                    id="fieldsetHorizontal"
                    horizontal
                    :label-cols="2"
                    breakpoint="md"
                    label="Career Description"
                    label-for="careerDesc">
                <b-form-textarea
                    id="careerDesc"
                    v-model="desc"
                    placeholder="Description"
                    :rows="3"
                    :max-rows="6"
                    :no-resize="true"
                ></b-form-textarea>
            </b-form-group>

        </div>
    </div>

    <div class="row m--margin-top-10">
        <div class="col-6">
            Milestones:
            <input v-model="milestoneName">
            <button @click="addList(milestoneName)">Add new</button>
            <ul v-for="(milestone, index) in milestonesList">
                <li>{{index}} - {{milestone}}</li>
            </ul>
        </div>
    </div>

    <button @click="submit">submit</button>
    <button @click="clear">clear</button>

    <b-alert variant="success"
             dismissible
             :show="showDismissibleAlert"
             @dismissed="showDismissibleAlert=false">
        Success!
    </b-alert>
</div>
</template>

<script>

    import axios from 'axios';


    export default {
        name: "adddevelopment",

        data(){

            return{
                desc:'',
                title:'',
                showDismissibleAlert:false,
                selected:[],
                careerRoles:[],
                milestonesList:[],
                milestoneName:'',
                careerRoleTitle:'',


            }
        },
        mounted(){

            this.fetchData();
        },
        methods:{

            addList(value){
                this.milestonesList.push(value);
                this.milestoneName='';
            },


            fetchData: function () {
                axios.get('/career/roles')
                    .then(response => {
                        let careerRole = [];
                        for (let i = 0; i < response.data.length; i++) {
                            const data = response.data[i];
                            careerRole[careerRole.length] = {
                                label: data.title,
                                value: data.id,
                            }
                        }
                        this.careerRoles = careerRole;
                    });
            },


            clear: function () {
                this.desc='';
                this.title='';
            },

            submit: function () {

                const data = [{
                    title: this.title,
                    description: this.desc,
                    milestonesList: this.milestonesList
                }];

                this.desc='';
                this.title='';
                this.milestonesList='';
                let vm=this;
                axios.post('/career/add', data)
                    .then(response => {
                        if(response.status===200){

                            this.showDismissibleAlert=true;
                        }
                    }).catch(error => {

                });
            }
        }
    }
</script>

<style scoped>

</style>