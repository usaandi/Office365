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
                        <td><span class="btn btn-success" @click="editCareerTemplate(career, index)">Edit </span></td>
                        <td><span><button type="button"
                                          class="btn btn-danger">Delete</button></span></td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <modal v-if="showModal">


            <h3 slot="header">
                {{placeHolderTask}}
            </h3>

            <div slot="body" class="admin__form admin__form--clear">
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row"><label for="careerTask"
                                                                     class="col-sm-3 col-xs-12  col-form-label">Career
                        Task</label>
                        <div class="col-sm-9 col-xs-12 "><input v-model="careerTaskTitle" required=""
                                                                name="CareerName" type="text"
                                                                id="careerTask"
                                                                placeholder="Career Task"
                                                                class="form-control m-input"
                        ></div>
                    </div>
                    <div class="form-group m-form__group row"><label for="careerDescription"
                                                                     class="col-sm-3 col-xs-12 col-form-label">Description</label>
                        <div class="col-sm-9 col-xs-12"><textarea required="" maxlength="1000" id="careerDescription"
                                                                  rows="3" class="form-control m-input"
                                                                  v-model="careerDescription"
                                                                  name="description"></textarea></div>
                    </div>
                    <div class="form-group m-form__group row m--margin-top-15"><label for="milestoneName"
                                                                                      class="col-sm-3 col-xs-12  col-form-label">Milestone</label>
                        <div class="col-sm-9 col-xs-12 "><input required="" name="milestoneName" type="text"
                                                                placeholder="Milestone Name"
                                                                id="milestoneName"
                                                                class="form-control m-input"></div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12"></div>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="profile-timeline__action">
                                        <button @click="" type="button"
                                                class="btn m-btn--pill btn-success m-btn m-btn--custom">New Milestone
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label for="Milestones" class="col-3 col-form-label">Milestones:</label>
                        <div class="col-9" id="Milestones">
                            <ul v-for="(milestone, index) in careerMilestones" :style="'listStyleType:none'">
                                <li>{{milestone.task}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-10">
            </div>
            <div slot="footer">
                <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom"
                        @click="clearModalData">CANCEL
                </button>
                <button type="submit" class="btn m-btn--pill btn-success" @click="updateCareer">SUBMIT</button>
            </div>
        </modal>
    </div>
</template>

<script>
    import axios from 'axios';

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
                showModal: false,

                careerTaskTitle: null,
                careerDescription: null,
                careerMilestones: null,
                careerRoleId: null,
                currentIndex: null,
                placeHolderTask: null,


            }
        },
        computed: {},
        methods: {
            milestoneLength(milestones) {
                return milestones.length;
            },
            clearModalData() {
                if (this.showModal) {

                    this.careerTaskTitle = null;
                    this.careerDescription = null;
                    this.careerMilestones = null;
                    this.careerRoleId = null;
                    this.currentIndex = null;
                    this.placeHolderTask = null;
                    this.showModal = false;
                }
            },
            editCareerTemplate(currentCareer, index) {

                this.careerTaskTitle = currentCareer.task;
                this.careerDescription = currentCareer.description;
                this.careerRoleId = currentCareer.career_role_id;
                this.currentIndex = index;
                this.careerMilestones = currentCareer['milestones'];
                this.placeHolderTask = currentCareer.task;
                this.showModal = true;
            },
            updateCareer() {

                if (this.careerTaskTitle && this.careerDescription) {
                    const data = {
                        careerTask: this.careerTaskTitle,
                        careerDescription: this.careerDescription,
                    };

                    axios.patch('admin/career/template/manager/' + this.careerRoleId, data).then(response => {

                        this.careerList[this.currentIndex].task = response.data.title;
                        this.careerList[this.currentIndex].description = response.data.description;

                        this.careerTaskTitle = null;
                        this.careerDescription = null;
                        this.careerMilestones = null;
                        this.careerRoleId = null;
                        this.currentIndex = null;
                        this.placeHolderTask = null;
                        this.success = true;
                        this.showModal = false;
                    });

                }

            }

        }
    }
</script>

<style scoped>

</style>