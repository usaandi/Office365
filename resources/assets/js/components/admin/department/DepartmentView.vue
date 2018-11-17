<template>
    <div>
        <modal v-show="show">

            <h3 slot="header">
                Department
            </h3>

            <div slot="body">


            </div>
            <div slot="footer">
                <button type="button" class="btn btn-success" @click="">CANCEL</button>
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
        props: ['departments'],
        name: "DepartmentView",
        data() {
            return {
                show: false,
                updateObject: {}
            }
        },
        watch: {
            updateObject(value) {
                this.updateObject = value;
            }
        },
        methods: {
            update(object) {
                this.updateObject = object;
                console.log(this.updateObject);
            }
        }
    }
</script>

<style scoped>

</style>