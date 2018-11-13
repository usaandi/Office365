<template>
    <div>
        <div class="profile-timeline__form">
            <form class="m-form">
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label for="title" class="col-3 col-form-label">Role</label>
                        <div class="col-9">
                            <input id="title" class="form-control m-input" placeholder="Role" v-model="title">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="desc" class="col-3 col-form-label">Description</label>
                        <div class="col-9">
                            <input id="desc" class="form-control m-input" placeholder="title" v-model="desc">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="milestone" class="col-3 col-form-label">Milestone</label>
                        <div class="col-9">
                            <input v-model="milestoneName"  type="text" id="milestone" class="form-control m-input" placeholder="Milestone Name">
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12"></div>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="profile-timeline__action">
                                        <button @click="addList(milestoneName)" type="button"
                                                class="btn m-btn--pill btn-success m-btn m-btn--custom">New Milestone
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="desc" class="col-3 col-form-label">Milestones:</label>
                        <div class="col-9">
                            <ul v-for="(milestone, index) in milestonesList">
                                <li>{{index}} - {{milestone}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-10">
                        <div class="m-form__actions">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12"></div>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="profile-timeline__action">
                                        <button @click="clear()" type="button"
                                                class="btn m-btn--pill btn-success m-btn m-btn--custom">Clear Milestones
                                        </button>
                                        <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom"
                                                @click="submit()">Submit
                                        </button>
                                    </div>
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
        name: "adddevelopment",

        data() {

            return {
                desc: '',
                title: '',
                showDismissibleAlert: false,
                selected: [],
                careerRoles: [],
                milestonesList: [],
                milestoneName: '',
                careerRoleTitle: '',


            }
        },
        mounted() {

            this.fetchData();
        },
        methods: {

            addList(value) {
                this.milestonesList.push(value);
                this.milestoneName = '';
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
                this.desc = '';
                this.title = '';
                this.milestonesList = [];
            },

            submit: function () {

                const data = [{
                    title: this.title,
                    description: this.desc,
                    milestonesList: this.milestonesList
                }];

                this.desc = '';
                this.title = '';
                this.milestonesList = '';
                let vm = this;
                axios.post('/career/add', data)
                    .then(response => {
                        if (response.status === 200) {

                            this.showDismissibleAlert = true;
                        }
                    }).catch(error => {

                });
            }
        }
    }
</script>

<style scoped>

</style>