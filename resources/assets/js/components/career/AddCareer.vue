<template>
    <div>
        <div class="profile-timeline__form">
            <form class="m-form">
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label for="title" class="col-3 col-form-label">Role</label>
                        <div class="col-9">
                            <input id="title" required class="form-control m-input" placeholder="Role" v-model="title">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="desc" class="col-3 col-form-label">Role Description</label>
                        <div class="col-9">
                            <textarea id="desc" required class="form-control m-input" rows="8" placeholder="Role description"
                                      v-model="desc"></textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="milestone" class="col-3 col-form-label">Milestone</label>
                        <div class="col-9">
                            <input
                                    v-model="milestoneName" type="text"
                                    id="milestone" class="form-control m-input"
                                    placeholder="Milestone Name">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label for="milestoneDescription" class="col-3 col-form-label">Milestone Description</label>
                        <div class="col-9">
                            <textarea
                                    v-model="milestoneDescription" rows="8"
                                    id="milestoneDescription" class="form-control col-xs-12"
                                    placeholder="Milestone description"></textarea>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12"></div>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="profile-timeline__action">
                                        <button @click="addList(milestoneName,milestoneDescription)" type="button"
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
                                <li>{{milestone.milestoneName}}</li>
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
                milestonesList: [],
                milestoneName: '',
                careerRoleTitle: '',
                milestoneDescription: null,
                showError: false,


            }
        },
        mounted() {

        },
        methods: {
            checkError() {

            },

            addList(milestoneName, milestoneDescription) {

                if (this.milestoneName) {
                    this.milestonesList.push({
                        milestoneName: milestoneName,
                        milestoneDescription: milestoneDescription
                    });
                    this.milestoneName = null;
                    this.milestoneDescription = null;
                }
            },

            clear: function () {
                this.desc = '';
                this.title = '';
                this.milestonesList = [];
            },

            submit: function () {

                if (this.desc && this.title) {

                    const data = [{
                        title: this.title,
                        description: this.desc,
                        milestonesList: this.milestonesList
                    }];

                    this.clear();
                    let vm = this;
                    axios.post('admin/career/add', data)
                        .then(response => {
                            if (response.status === 200) {
                                window.location.href = "/admin/career-template/list";
                            }
                        }).catch(error => {

                    });
                }
            }

        }
    }
</script>

<style scoped>

</style>