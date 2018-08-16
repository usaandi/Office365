<template>
    <div>
        <div class="">
            <div class="fc-button-group">
                <button @click="edit=!edit" >Edit</button>
            </div>
                <div v-for="(child, index) in userchildren">
                    <p class="d-inline-block">Nimi: {{ child.name }} | Vanus: {{child.age}}</p>
                    <button v-show="edit"@click="deleteRow(child.id,index)">X</button>
                </div>
            <label v-show="edit">Year born</label><input  v-show="edit" type="date" v-model="dateborn">
            <label v-show="edit">Child name</label><input v-show="edit" v-model="childname" placeholder="Child name">
            <button v-show="edit" @click="upload()" >+Add new</button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';


    export default {
        name: "UserChildren",
        props: ['userid'],
        data() {
            return {
                edit:false,
                id: '',
                userchildren: [],
                dateborn:'',
                childname:'',
            }
        },
        mounted() {
            this.id = this.userid;
            this.fetchData();

        },
        methods:{
            fetchData: function () {
                axios.get('http://localhost/user/' + this.id + '/child')
                    .then(response => {
                        this.userchildren = response.data;
                    });
            },
            upload: function () {

                let data= JSON.stringify({
                    childname: this.childname,
                    dateborn: this.dateborn,

                });
                let vm = this;
                axios.post('http://localhost/user/' + this.id + '/update/child',data)
                    .then(response => {
                        if (vm.childname!==null){

                            vm.userchildren.push({
                                id: response.data.child_id,
                                name: response.data.child_name,
                                age: response.data.age,

                            })
                        }


                }).catch(error => {

                });

            },

            deleteRow: function (childId) {
                let vm =this;
                axios.delete('http://localhost/user/'+ this.id +'/delete/child', {params: {id: childId}})
                    .then(function (response) {
                        let index = vm.userchildren.findIndex(function(obj){
                            return obj.id === childId;
                        });
                        if (index !== -1) {
                            vm.userchildren.splice(index, 1);
                        }
                    } )


            },

        }
    }
</script>

<style scoped>

    input{
        display: block;
    }
</style>