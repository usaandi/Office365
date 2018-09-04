<template>
    <div>
        <h3 class="profile__subtitle">Children</h3>
        <div class="m-subheader__action">
            <a @click="edit=!edit" class="btn btn-success m-btn m-btn--icon m-btn--pill">
              <span>
										<i class="la la-plus"></i>
										<span>New</span>
              </span>
            </a>
        </div>
        <div class="profile__details">
            <div class="row" v-for="(child,index) in userchildren">
                <div class="col-xs-3">
                    <div class="profile__details--title">{{child.name}}</div>
                </div>
                <div class="col-xs-9">
                    <div class="profile__details--info">{{child.age}}a</div>
                    <button v-show="edit" @click="deleteRow(child.id,index)">X</button>
                </div>
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
                axios.get('/user/' + this.id + '/child')
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
                axios.post('/user/' + this.id + '/update/child',data)
                    .then(response => {
                        if (vm.name!==null){

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
                axios.delete('/user/'+ this.id +'/delete/child', {params: {id: childId}})
                    .then(function (response) {
                        let index = vm.userchildren.findIndex(function(obj){
                            return obj.id === childId;
                        });
                        if (index !== -1) {
                            vm.userchildren.splice(index, 1);
                        }
                    } )


            },

            reachTest: function () {
                console.log('hey');
            }

        }
    }
</script>

<style scoped>

    input{
        display: block;
    }
</style>