<template>
    <div>
        <h3 class="profile__subtitle">Hobbies</h3>
        <div class="m-subheader__action">
            <a @click="edit=!edit" v-show="!edit && canedit" tabindex=""
               class="btn btn-success m-btn m-btn--icon m-btn--pill m--margin-bottom-15">
              <span>
                    <i class="la la-plus"></i>
                    <span>Edit</span>
              </span>
            </a>
        </div>
        <ul class="profile__tags clearfix">
            <li v-for="hobby in userhobbies"><a style="color: #34bfa3">#{{hobby.name}}</a>
                <button v-show="edit" @click="deleteRow(hobby.id)"
                        class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill"><i
                        class="icon flaticon-delete-1"></i></button>
            </li>
        </ul>
        <user-hobby-form v-show="edit"
                         @close="edit=false"
                         @hobbyName="upload($event)"
        ></user-hobby-form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "UserHobby",
        props: ['userid', 'canedit'],
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
        methods: {


            deleteRow: function (userHobbyId) {
                if (this.canedit) {
                    let vm = this;
                    axios.delete('/user/' + this.id + '/delete/hobby', {params: {userhobbyid: userHobbyId}})
                        .then(function (response) {
                            let index = vm.userhobbies.findIndex(function (obj) {
                                return obj.id === userHobbyId;
                            });
                            if (index !== -1) {
                                vm.userhobbies.splice(index, 1);
                            }
                        })
                }
            },
            fetchData: function () {
                axios.get('/user/' + this.id + '/hobby')
                    .then(response => {
                        this.userhobbies = response.data;
                    });
            },

            upload: function (value) {
                if (this.canedit) {

                    let vm = this;
                    axios.post('/user/' + this.id + '/update/hobby', {data: value})
                        .then(response => {
                            vm.userhobbies.push({
                                id: response.data[0].id,
                                name: response.data[0].name,
                            });
                        }).catch(error => {
                    });
                }
            },


        }
    }
</script>

<style scoped>

</style>