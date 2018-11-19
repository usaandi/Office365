<template>
    <div>
        <modal v-show="show">

            <h3 slot="header">
                {{updateObject.department_name}}
            </h3>

            <div slot="body" class="profile__form">

                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <div class="m--margin-left-10 col-9">
                            <input type="text"
                                   placeholder="Hobby" v-model="updateObject.department_name"
                                   class="form-control m-input">
                        </div>
                    </div>
                </div>


            </div>
            <div slot="footer">
                <button type="button" class="btn btn-success" @click="close">CANCEL</button>
                <button type="submit" class="btn btn-success" @click="">SUBMIT</button>
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
                        @update="update($event)"
                    >


                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['prop'],
        name: "DepartmentView",
        data() {
            return {
                show: false,
                updateObject: {},
                departments: this.prop
            }
        },
        watch: {
            updateObject(value) {
                this.updateObject = value;
            }
        },
        methods: {
            update(object) {
                for (let i = 0; i < this.departments.length; i++) {
                    if (this.departments[i].id === object.id) {
                        this.updateObject = this.departments[i];
                        console.log('hey im here');

                    }
                }

                this.show = true;
            },

            close() {
                if (this.show) {

                    this.updateObject = {};
                    this.show = false;
                }
            }
        }
    }
</script>

<style scoped>

</style>