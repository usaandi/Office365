<template>
    <div>
        <h3 class="profile__subtitle">Hobbies</h3>
        <div class="m-subheader__action">
            <a @click="edit=!edit" class="btn btn-success m-btn m-btn--icon m-btn--pill">
              <span>
                    <i class="la la-plus"></i>
                    <span>New</span>
              </span>
            </a>
        </div>
        <ul class="profile__tags clearfix" v-for="hobby in userhobbies">
            <li><a >#{{hobby.name}}</a></li>
            <button v-show="edit" class="" @click="deleteRow(hobby.id)">X</button>
        </ul>
        <user-hobby-form v-show="edit"
                         @hobbyName="upload($event)"
        ></user-hobby-form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "UserHobby",
        props: ['userid','canedit'],
        data() {
            return {
                id: '',
                userhobbies: [],
                hobbyname: '',
                edit: false
            }
        },
        mounted() {
            this.id = this.userid;
            this.fetchData();
            this.edit = this.canedit;
        },
        methods:{



            deleteRow: function(userHobbyId){
                let vm =this;
                axios.delete('/user/'+ this.id +'/delete/hobby', {params: {userhobbyid: userHobbyId}})
                    .then(function (response) {
                        let index = vm.userhobbies.findIndex(function(obj){
                            return obj.id === userHobbyId;
                        });
                        if (index !== -1) {
                            vm.userhobbies.splice(index, 1);
                        }
                    } )
            },
            fetchData: function () {
                axios.get('/user/' + this.id + '/hobby')
                    .then(response => {
                        this.userhobbies = response.data;
                    });
            },

            upload: function (value) {
                let vm = this;
                axios.post('/user/' + this.id + '/update/hobby',{data: value})
                    .then(response => {
                        vm.userhobbies.push({
                            id: response.data[0].id,
                            name: response.data[0].name,
                        });
                        vm.edit = false;
                    }).catch(error => {
                    });
            },

        }
    }
</script>

<style scoped>

</style>