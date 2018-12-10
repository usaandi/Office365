<template>
    <div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row m--margin-bottom-15">
                    <div class="col-sm-3 col-xs-12">

                        <div v-show="success" class="alert alert-success alert-dismissible">
                            <a class="close" @click="success=!success"></a>
                            <strong>Success!</strong>
                        </div>


                    </div>
                    <div class="col-sm-9 col-xs-12">
                        <div class="profile-timeline__action ">

                            <a :href="'admin/career/add'" class="btn btn-success m-btn m-btn--icon m-btn--pill ">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>Add Career Template</span>
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
                        <th>Career Task</th>
                        <th>Career Description</th>
                        <th>Milestone Count</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(career,index) in careers"
                        :key="index"
                        :index="index">

                        <td><span>{{career.career_role_id}}</span></td>
                        <td><span>{{career.task}}</span></td>
                        <td><span>{{career.description}}</span></td>
                        <td><span>{{milestoneLength(career['milestones'])}}</span></td>
                        <td><span class="btn btn-success" >Edit </span></td>
                        <td><span><button type="button"
                                          class="btn btn-danger">Delete</button></span></td>


                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            careerList: {
                required: true
            }
        },
        name: "CareerTemplateManager",
        data() {
            return {
                careers: this.careerList,
                success: false,
            }
        },
        computed: {

        },
        methods:{
            milestoneLength(milestones){
                return milestones.length;
            }
        }
    }
</script>

<style scoped>

</style>