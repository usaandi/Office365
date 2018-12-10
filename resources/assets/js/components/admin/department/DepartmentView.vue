<template>
    <div>
        <modal v-show="showUpdate">


            <h3 slot="header">
                Department: {{departmentName}}
            </h3>

            <div slot="body" class="admin__form admin__form--clear">
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row"><label for="department"
                                                                     class="col-sm-3 col-xs-12  col-form-label">Department</label>
                        <div class="col-sm-9 col-xs-12 "><input required="" name="departmentName" type="text" id="department"
                                                                placeholder="Department Name"
                                                                class="form-control m-input"
                                                                v-model="departmentName"></div>
                    </div>
                    <div class="form-group m-form__group row"><label for="abbreviation"
                                                                     class="col-sm-3 col-xs-12  col-form-label">Abbreviation</label>
                        <div class="col-sm-9 col-xs-12 "><input required="" name="departmentAbbr" type="text"
                                                                placeholder="Department abbreviation"
                                                                id="abbreviation"
                                                                v-model="departmentAbbr"
                                                                class="form-control m-input"></div>
                    </div>
                    <div class="form-group m-form__group row"><label for="textArea"
                                                                     class="col-sm-3 col-xs-12 col-form-label">Description</label>
                        <div class="col-sm-9 col-xs-12"><textarea required="" maxlength="1000" id="textArea"
                                                                  rows="3" class="form-control m-input"
                                                                  v-model="departmentDesc"
                                                                  name="description"></textarea></div>
                    </div>
                </div>

            </div>
            <div slot="footer">
                <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom" @click="close">CANCEL</button>
                <button type="submit" class="btn m-btn--pill btn-success" @click="submit">SUBMIT</button>
            </div>
        </modal>

        <div class="m-portlet__foot m-portlet__foot--fit">

            <div class="m-form__actions">
                <div class="row m--margin-bottom-15">
                    <div class="col-sm-3 col-xs-12">

                        <div v-show="success" class="alert alert-success alert-dismissible" >
                            <a class="close" @click="success=!success"></a>
                            <strong>Success!</strong>
                        </div>

                        <div v-show="deleteStatus" class="alert alert-danger">
                            <p><strong>Delete {{departmentName}} ?</strong></p>
                            <div class="btn-group">

                                <button class="btn btn-primary" @click="deleteFalse"><span>Cancel</span></button>

                                <button class="btn btn-danger" @click="deleteTrue"><span>Submit</span></button>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-9 col-xs-12">
                        <div class="profile-timeline__action ">

                            <a :href="'department/add'" class="btn btn-success m-btn m-btn--icon m-btn--pill ">
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
                        @deleteRequest="deleteRequest($event)"
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
                showUpdate: false,
                success: false,
                updateObject: {},
                showDelete: false,
                deleteStatus: false,

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

            deleteTrue() {

                let data = {
                    departmentId: this.departmentId,
                };

                let vm = this;
                axios.delete('/admin/department/delete', {params: data})
                    .then(function (response) {
                        if (response.status === 200) {
                            vm.departments.splice(vm.departmentIndex, 1);
                            vm.deleteStatus = false;
                            vm.departmentId = null;
                            vm.departmentName = null;
                            vm.departmentIndex = null;
                            vm.success = true;

                        }
                    });


            },
            deleteFalse() {
                this.deleteStatus = false;
                this.departmentId = null;
                this.departmentName = null;
                this.departmentIndex = null;

            },

            getIndex(index) {
                this.departmentIndex = index;

            },
            deleteRequest(object) {
                this.departmentId = object.id;
                this.departmentName = object.department_name;
                this.deleteStatus = true;
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
                        if (response.status === 200) {
                            this.departments[this.departmentIndex] = response.data;

                            this.departmentAbbr = null;
                            this.departmentDesc = null;
                            this.departmentName = null;
                            this.departmentId = null;
                            this.departmentIndex = null;
                            this.updateObject = {};
                            this.success = true;
                            this.showUpdate = false;
                        }

                    });

                    this.showUpdate = false;
                }


            },
            edit(object) {
                this.departmentAbbr = object.department_abbr;
                this.departmentDesc = object.department_info;
                this.departmentName = object.department_name;
                this.departmentId = object.id;

                this.showUpdate = true;
            },

            close() {
                if (this.showUpdate) {
                    this.showUpdate = false;
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