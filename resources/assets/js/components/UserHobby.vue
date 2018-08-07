<template>
    <div>
        <div>
            <div class="fc-button-group">
                    <button @click="edit=!edit" >Edit</button>
            </div>
                <div class="" v-for="hobby in userhobbies">
                    <p class="d-inline-block">#{{ hobby.hobby_name }}</p>
                    <button v-show="edit" class="" @click="deleteRow(hobby.id)">X</button>
                </div>
            <button v-show="edit" @click="upload()" >+Add new</button>
            <input v-show="edit" v-model="hobbyname">
        </div>
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
                edit: 'false'
            }
        },
        mounted() {
            this.id = this.userid;
            this.fetchData();
            console.log(this.canedit);
            this.edit = this.canedit;
        },
        methods:{

            deleteRow: function(userHobbyId){
                console.log(userHobbyId);
                let vm =this;
                axios.delete('http://localhost/user/'+ this.id +'/delete/hobby', {params: {userhobbyid: userHobbyId}})
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
                axios.get('http://localhost/user/' + this.id + '/hobby')
                    .then(response => {
                        this.userhobbies = response.data;
                    });
            },

            upload: function () {
                let vm = this;
                axios.post('http://localhost/user/' + this.id + '/update/hobby',{data: this.hobbyname})
                    .then(response => {
                        vm.userhobbies.push({
                            id: response.data.user_hobby_id,
                            hobby_name: response.data.hobby_name
                        });
                        vm.edit = false;
                    }).catch(error => {
                        console.log(error.response.data);
                    });
            },

        }
    }
</script>

<style scoped>

</style>