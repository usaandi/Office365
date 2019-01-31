<template>
    <div>
        <modal v-if="showModal">

            <h3 slot="header">
                {{selectedUser.name}}
            </h3>

            <div slot="body" class="container">
                <div>
                    <div class="row m-form__group">
                        <label for="positions" class="col-xs-12 m--font-brand">Position</label>
                        <input v-model="selectedUser.position" list="positions" type="text"
                               class="form-control col-xs-12 col-lg-3"
                               placeholder="Position"/>
                        <datalist id="positions">
                            <option v-for="position in positions">{{position.position_name}}</option>
                        </datalist>
                    </div>
                    <div class="form-group row">
                        <label for="positions" class="col-xs-12 m--font-brand">Technology</label>
                        <input v-model="technologyName" type="text"
                               class="form-control col-xs-12 col-lg-3"
                               placeholder="Technology name"/>
                        <div class="col-lg-9">
                            <button class=" btn m-btn--pill btn-success right " @click="addTechnology(technologyName)">
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-xs-12 m--font-brand">Technology List</label>
                        <ul class="list-unstyled list-group-item col-lg-6 col-xs-12">
                            <li :key="index" v-for="(technology, index) in technologiesList" class="list-inline-item">
                                {{technology['technologyName']}}
                                <span style="display: inline-block;" @click="deleteTechnology(index)"><i
                                        class="fa fa-trash m--margin-left-10"></i></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div slot="footer" class="m-portlet__foot m-portlet__foot--fit m--margin-top-10">
                <div>
                    <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom m--margin-5"
                            @click="closeModal()">Cancel
                    </button>
                    <button type="submit" class="btn m-btn--pill btn-success m--margin-5" @click="saveUser()">Submit
                    </button>
                </div>
            </div>

        </modal>
        <div class="container">

            <div class="row">
                <div class="col-sm-12 col-xs-12" v-for="(error, index) in errorsList " v-show="hideError">
                    <div class="alert alert-danger alert-dismissible text-center" style="" :key="index"><a
                            @click="hideError=!hideError" class="close"></a> <strong>{{error.errorMessage}}</strong>
                    </div>
                </div>
            </div>
            <div class="m-form__group row m--margin-top-15">
                <label for="projectName" class="col-xs-12 m--font-brand">
                    Project name
                </label>
                <input type="text" class="form-control col-xs-12" id="projectName"
                       placeholder="Project name" v-model="projectTitle"/>
            </div>

            <div class="m-form__group row  m--margin-top-15">
                <label for="date1" class="col-xs-12 col-md-1 m--font-brand">Begin date</label>
                <div class="input-group  col-md-4">
                    <input type="text" id="date1" class="form-control" v-model="startDate">
                </div>
            </div>


            <div class="m-form__group row  m--margin-top-15">

                <label for="date2" class="col-xs-12 col-md-1 m--font-brand">End date</label>
                <div class="input-group date col-md-4">
                    <input type="text" class="form-control" id="date2" v-model="endDate">
                </div>
            </div>


            <div class="m-form__group row m--margin-top-15">

                <label for="projectClient" class="col-xs-12 m--font-brand">
                    Client
                </label>
                <input v-model="clientName" list="clients" type="text" class="form-control col-xs-12" id="projectClient"
                       placeholder="Client"/>
                <datalist id="clients">
                    <option v-for="client in clients">{{client.client_name}}</option>

                </datalist>

            </div>

            <div class="m-form__group row m--margin-top-15">

                <label for="description" class="col-xs-12 m--font-brand">Description</label>
                <textarea id="description" class="form-control col-xs-12" rows="10"
                          placeholder="Description" v-model="projectDescription"></textarea>

            </div>


            <div class="m-form__group row m--margin-top-15">

                <label for="button-addon6" class=" col-xs-12 m--font-brand">
                    Inimesed
                </label>
                <div class="input-group col-xs-12 m--margin-top-10 " v-for="(user, index ) in projectUsers"
                     :key="index">
                    <div class="form-control"> {{user.name}}</div>
                    <div class="input-group-append" style="margin-right: 30px;" id="button-addon6">
                        <button class="btn m-btn--pill btn-outline-danger m-btn m-btn--custom"
                                type="button" @click="removeUser(index)">
                            Remove
                        </button>
                        <button class="btn m-btn--pill btn-outline-warning m-btn m-btn--custom"
                                type="button" @click="editUser(index)">
                            Edit
                        </button>
                    </div>
                </div>

            </div>

            <div class="m-form__group row m--margin-top-15" v-show="showSearch">

                <label for="searchName" class="col-xs-12 m--font-brand">
                    Search People
                </label>

                <div class="input-group  col-xs-12 position-relative">
                    <input type="text" class="form-control " id="searchName" @input="searchPeople" v-model="query"
                           placeholder="Search People..."/>
                    <div class="input-group-append">
                        <button class="btn m-btn--pill btn-outline-info m-btn m-btn--custom"
                                @click="closeSearch"
                                type="button">
                            Close
                        </button>
                    </div>
                </div>

                <div class="row m--margin-top-15">
                    <div class="col-lg-12">
                        <ul class="list-unstyled list-group-item " v-if="resultUser.length > 0">
                            <li v-for="(user, index) in userList" :key="index" class="list-inline-item "
                                :id="user.id">{{user.name}}
                                <i class="fas fa-arrow-up fa-1x m--margin-right-10" @click="pushNewUser(user)"
                                ></i>

                            </li>
                        </ul>
                        <div v-if="searching" class="list-group-item">
                            <div v-if="resultUser.length <= 0" class="list-inline-item ">
                                Nothing found
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-form__group row m--margin-top-15" v-show="!showSearch">

                <div class="col-sm-3 col-xs-12">
                    <a tabindex="" @click="showSearch=!showSearch"
                       class="btn m-btn--pill btn-outline-success m-btn m-btn--custom"><span><i
                            class="la la-plus"></i> <span
                    >Add Peoples</span></span></a>
                </div>
                <div class="col-sm-9 col-xs-12">
                    <div class="profile-timeline__action">
                        <button type="button"
                                class="btn m-btn--pill btn-outline-info m-btn m-btn--custom">Cancel
                        </button>
                        <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom"
                                @click="createProject"
                        >Save
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        props: {
            clients: {},
            positions: {}
        },
        name: "ProjectCreateView",
        data() {
            return {
                hideError: false,
                projectTitle: null,
                projectDescription: null,
                startDate: null,
                clientName: null,
                endDate: null,

                projectUsers: [],
                inputErrors: [],
                showModal: false,
                technologyName: null,

                showSearch: false,
                searching: false,
                currentIndex: null,
                query: null,
                selectUserPosition: null,
                selectedUserTechnologies: null,
                selectedUser: null,
                resultUser: [],

            }
        },
        mounted: function () {


            $('#date1').datepicker({
                format: 'dd/mm/yyyy',
                minViewMode: 1,
                maxViewMode: 2,
                orientation: "bottom auto",
                autoclose: true,
            }).on('changeDate', event => {

                let minDate = new Date(event.target.value);

                $('#date2').datepicker('setStartDate', minDate);
                this.startDate = event.target.value;

            });


            $('#date2').datepicker({
                format: 'dd/mm/yyyy',
                minViewMode: 1,
                orientation: "bottom auto",
                maxViewMode: 2,
                startDate: this.startDate,
                autoclose: true,
            }).on('changeDate', event => {
                let maxDate = new Date(event.target.value);
                $('#date1').datepicker('setEndDate', maxDate);
                this.endDate = event.target.value;
            });


        },
        computed: {

            technologiesList() {
                return this.selectedUserTechnologies;
            },

            currentUser() {
                return this.projectUsers[this.currentIndex];
            },

            userList() {
                return this.resultUser;
            },
            errorsList() {
                return this.inputErrors;
            }
        },
        watch: {
            currentIndex() {

            }
        },
        methods: {

            deleteTechnology(index) {
                this.selectedUserTechnologies.splice(index, 1);
            },

            addTechnology(technology) {
                this.selectedUserTechnologies.push({technologyName: technology});

                this.technologyName = null;

            },
            closeSearch() {
                this.resultUser = [];
                this.query = null;
                this.searching = false;
                this.showSearch = false;

            },

            saveUser() {
                this.projectUsers[this.currentIndex] = this.selectedUser;
                this.currentIndex = null;
                this.selectedUser = null;
                this.showModal = false;

            },
            createProject() {

                if (this.checkErrors()) {

                    const data = {
                        projectTitle: this.projectTitle,
                        startDate: this.startDate,
                        endDate: this.endDate,
                        clientName: this.clientName,
                        projectDescription: this.projectDescription,
                        projectUsers: this.projectUsers,
                    };

                    axios.post('/admin/project-create', data).then(response => {
                    })
                }

            },
            editUser(index) {
                this.currentIndex = index;
                this.selectedUser = this.currentUser;
                this.selectedUserTechnologies = this.projectUsers[this.currentIndex].technologies;
                this.showModal = true;
            },
            closeModal() {
                this.selectedUserTechnologies = null;
                this.currentIndex = null;
                this.selectedUser = null;
                this.showModal = false;
            },

            checkErrors() {

                let errors = [];

                if (!this.projectTitle) {
                    errors.push({errorMessage: 'Title is missing!'});
                }
                if (!this.projectDescription) {
                    errors.push({errorMessage: 'Description is missing!'});
                }
                if (!this.clientName) {
                    errors.push({errorMessage: 'Client name is missing!'});
                }
                if (!this.startDate) {
                    errors.push({errorMessage: 'Start date is missing!'});
                }

                if (errors.length === 0) {
                    return true;
                }
                this.hideError = true;
                this.inputErrors = errors;
                return false;
            },

            removeUser(index) {
                this.projectUsers.splice(index, 1);
            },

            pushNewUser(user) {

                let array = this.projectUsers;

                let found = array.some(el => {
                    return el.id === user.id;
                });
                if (!found) {
                    this.projectUsers.push({name: user.name, id: user.id, position: null, technologies: []});
                }
            },
            searchPeople: _.debounce(function () {
                if (this.query) {
                    const data = {
                        q: this.query
                    };
                    this.searching = true;
                    axios.post('/search', data).then(response => {
                        this.resultUser = response.data;

                        if (response.data.length <= 0) {
                        }
                        else {
                            this.searching = false;
                        }
                    });
                }
                else {
                    this.resultUser = [];
                    this.searching = false;
                }
            }, 500)
        }
    }
</script>

<style scoped>


</style>