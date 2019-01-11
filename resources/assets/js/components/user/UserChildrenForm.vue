<template>
    <div>
        <div class="profile__form">
            <form class="m-form">

                <div class="m-portlet__body">
                    <div class="form-group m-form__group row"><label class="col-3 col-form-label">Year born</label>
                        <div class="col-9">
                            <div class="input-group date">
                                <input class="form-control m-input"
                                       :class="{'border border-danger':!this.dateBorn,'border border-success': this.dateBorn }"
                                       required type="date" v-model="dateBorn">
                                <div class="input-group-append">
                                              <span class="input-group-text">
                                   <i class="la la-calendar-check-o"></i>
                                  </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row"><label class="col-3 col-form-label">Child name</label>
                        <div class="col-9"><input
                                :class="{'border border-danger':!this.childName,'border border-success': this.childName }"
                                v-model="childName" required type="text"
                                placeholder="Child name"
                                class="form-control m-input"></div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12"></div>
                            <div class="col-sm-9 col-xs-12">
                                <div class="profile-timeline__action">
                                    <button @click="closeForm()"
                                            class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">
                                        Close
                                    </button>

                                    <a @click="checkError()" tabindex=""
                                       class="btn btn-success m-btn m-btn--icon m-btn--pill">
                                            <span>
                                          <i class="la la-plus"></i>
                                          <span>Add new</span>
                                    </span>
                                    </a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "UserChildrenForm",
        props: ['userId'],
        data() {
            return {
                dateBorn: null,

                childName: null,

            }

        },
        methods: {
            closeForm() {
                this.dateBorn = null;
                this.childName = null;
                this.$emit('close');
            },
            checkError() {
                if (this.dateBorn && this.childName) {

                    this.upload();
                }

            },


            upload: function () {


                let data = JSON.stringify({
                    childname: this.childName,
                    dateborn: this.dateBorn,

                });

                let vm = this;
                axios.post('/user/' + vm.userId + '/update/child', data)
                    .then(response => {
                        vm.childName = null;
                        vm.errors = null;

                        vm.dateBorn = null;

                        let data = response.data;
                        vm.$emit('update', data)


                    }).catch(error => {

                });

            },
        },
        watch: {
            dateBorn() {

            }
        },
        computed: {
            dateBornValue() {

            }
        }

    }
</script>

<style scoped>

</style>