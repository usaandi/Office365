<template>
    <div>
        <h3 class="profile__subtitle">Children</h3>
        <div class="m-subheader__action">
            <a @click="edit=!edit" v-show="!edit && canedit" tabindex=""
               class="btn btn-success m-btn m-btn--icon m-btn--pill profile__btn">
              <span>
										<i class="la la-plus"></i>
										<span>New</span>

              </span>
            </a>
        </div>
        <div class="">
            <div class="row" v-for="(child,index) in userchildren">
                <div class="col-xs-3">
                    <div class="profile__details--title">{{child.name}}</div>
                </div>
                <div class="col-xs-9">
                    <div class="profile__details--info">{{child.age}}a</div>
                    <button v-show="edit" @click="deleteRow(child.id, index)"
                            class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill"><i
                            class="la la-close"></i></button>
                </div>
            </div>
            <user-child-form v-show="edit" :userId="userid"
                             @update="updateData($event)"
                             @close="edit=false"
            ></user-child-form>
        </div>
    </div>

</template>

<script>
    import axios from 'axios';


    export default {
        name: "UserChildren",
        props: ['userid','canedit'],
        data() {
            return {
                edit: false,
                id: '',
                userchildren: [],
                dateborn: '',
                childname: '',
            }
        },
        mounted() {
            this.id = this.userid;
            this.fetchData();

        },
        methods: {
            updateData(data) {
                this.userchildren.push({
                    id: data.child_id,
                    name: data.child_name,
                    age: data.age,
                });
                this.edit = false;

            },
            fetchData: function () {
                axios.get('/user/' + this.id + '/child')
                    .then(response => {
                        this.userchildren = response.data;
                    });
            },

            deleteRow: function (childId) {
                let vm = this;
                axios.delete('/user/' + this.id + '/delete/child', {params: {id: childId}})
                    .then(function (response) {
                        let index = vm.userchildren.findIndex(function (obj) {
                            return obj.id === childId;
                        });
                        if (index !== -1) {
                            vm.userchildren.splice(index, 1);
                        }
                    })


            },

        }
    }
</script>

<style scoped>

    input {
        display: block;
    }
</style>