<template>
    <div class="container">
        <div class="m-form__group row m--margin-top-15">
            <label for="projectName" class="col-xs-12 m--font-brand">
                Project name
            </label>
            <input type="text" class="form-control col-xs-12" id="projectName"
                   placeholder="Project name"/>
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
            <input type="text" class="form-control col-xs-12" id="projectClient"
                   placeholder="Client"/>

        </div>

        <div class="m-form__group row m--margin-top-15">

            <label for="description" class="col-xs-12 m--font-brand">Description</label>
            <textarea id="description" class="form-control col-xs-12" rows="10"
                      placeholder="Description"></textarea>

        </div>

        <div class="m-form__group row m--margin-top-15">

            <label for="button-addon6" class=" col-xs-12 m--font-brand">
                Inimesed
            </label>
            <div class="input-group col-xs-12 m--margin-top-10">
                <div class="form-control"> Ain Arend</div>
                <div class="input-group-append" style="margin-right: 30px;" id="button-addon6">
                    <button class="btn m-btn--pill btn-outline-danger m-btn m-btn--custom"
                            type="button">
                        Remove
                    </button>
                    <button class="btn m-btn--pill btn-outline-warning m-btn m-btn--custom"
                            type="button">
                        Edit
                    </button>
                </div>
            </div>
        </div>

        <div class="m-form__group row m--margin-top-15" v-if="showSearch">

            <label for="searchName" class="col-xs-12 m--font-brand">
                Search People
            </label>

            <div class="input-group  col-xs-12 position-relative">
                <input type="text" class="form-control " id="searchName" @input="searchPeople" v-model="query"
                       placeholder="Search People..."/>
                <div class="input-group-append">
                    <button class="btn m-btn--pill btn-outline-info m-btn m-btn--custom" @click="showSearch=!showSearch" type="button">
                        Close
                    </button>
                </div>
            </div>

            <div class="row m--margin-top-15">
                <div class="col-lg-12">
                    <ul class="list-unstyled list-group-item " v-if="resultUser.length > 0">
                        <li v-for="(user, index) in userList" :key="index" class="list-inline-item "
                            :id="user.id">{{user.name}}
                            <i class="fas fa-arrow-up fa-1x m--margin-right-10"
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

        <div class="m-form__group row m--margin-top-15" v-if="!showSearch">

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
                    >Save
                    </button>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        name: "ProjectCreateView",
        data() {
            return {
                startDate: null,
                endDate: null,
                showSearch: false,
                searching: false,
                query: null,
                currentUser: [],
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
            userList() {
                return this.resultUser;
            }
        },
        methods: {
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