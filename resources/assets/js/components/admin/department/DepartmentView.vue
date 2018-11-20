<template>
    <div>
        <modal v-show="show">


            <h3 slot="header">
                Department: {{departmentName}}
            </h3>

            <div slot="body" class="admin__form admin__form--clear">
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row"><label for="example-text-input"
                                                                     class="col-sm-3 col-xs-12  col-form-label">Department</label>
                        <div class="col-sm-9 col-xs-12 "><input required="" name="departmentName" type="text"
                                                                placeholder="Department Name"
                                                                class="form-control m-input"
                                                                v-model="departmentName"></div>
                    </div>
                    <div class="form-group m-form__group row"><label for="example-text-input"
                                                                     class="col-sm-3 col-xs-12  col-form-label">Abbreviation</label>
                        <div class="col-sm-9 col-xs-12 "><input required="" name="departmentAbbr" type="text"
                                                                placeholder="Department abbreviation"
                                                                v-model="departmentAbbr"
                                                                class="form-control m-input"></div>
                    </div>
                    <div class="form-group m-form__group row"><label for="exampleTextarea"
                                                                     class="col-sm-3 col-xs-12 col-form-label">Description</label>
                        <div class="col-sm-9 col-xs-12"><textarea required="" maxlength="1000" id="exampleTextarea"
                                                                  rows="3" class="form-control m-input"
                                                                  v-model="departmentDesc"
                                                                  name="description"></textarea></div>
                    </div>
                </div>

            </div>
            <div slot="footer">
                <button type="button" class="btn btn-success" @click="close">CANCEL</button>
                <button type="submit" class="btn btn-success" @click="submit">SUBMIT</button>
            </div>
        </modal>

        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row m--margin-bottom-15">
                    <div class="col-sm-3 col-xs-12"></div>
                    <div class="col-sm-9 col-xs-12">
                        <div class="profile-timeline__action ">
                            <a :href="'department/add'" class="btn btn-success m-btn m-btn--icon m-btn--pill">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>Add Department</span>
                                    </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>

            <div class="table-responsive">
                <span class="float-left m--margin-bottom-5"></span>
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Department Name</th>
                        <th>Department Description</th>
                        <th>Department Abbreviation</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr is="admin-department-body" v-for="(department, index) in departments"

                        :key="index"
                        :department="department"
                        :index="index"
                        @index="getIndex($event)"
                        @update="edit($event)"
                    >


                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['prop'],
        name: "DepartmentView",
        data() {
            return {
                show: false,
                updateObject: {},

                departmentAbbr: null,
                departmentDesc: null,
                departmentName: null,
                departmentId: null,
                departmentIndex: null,

                departments: this.prop
            }
        },
        watch: {
            updateObject(value) {
                this.updateObject = value;
            },
            departments(value) {
            }
        },
        methods: {
            getIndex(index) {
                this.departmentIndex = index;

            },
            submit() {
                if (this.departmentAbbr && this.departmentDesc && this.departmentName) {

                    const data = {
                        'department_name': this.departmentName,
                        'department_info': this.departmentDesc,
                        'department_abbr': this.departmentAbbr,
                    };
                    let vm = this;

                    axios.post('/admin/department/update/' + vm.departmentId, data).then(response => {
                        this.departments[this.departmentIndex]=response.data;

                        this.departmentAbbr = null;
                        this.departmentDesc = null;
                        this.departmentName = null;
                        this.departmentId = null;
                        this.departmentIndex = null;
                        this.updateObject = {};
                        this.show = false;
                    });

                    this.show = false;
                }


            },
            edit(object) {
                this.departmentAbbr = object.department_abbr;
                this.departmentDesc = object.department_info;
                this.departmentName = object.department_name;
                this.departmentId = object.id;

                this.show = true;
            },

            close() {
                if (this.show) {
                    this.show = false;
                    this.departmentAbbr = null;
                    this.departmentDesc = null;
                    this.departmentName = null;
                    this.departmentId = null;
                    this.departmentIndex = null;
                    this.updateObject = {};
                }
            }
        }
    }
</script>

<style scoped>

</style>