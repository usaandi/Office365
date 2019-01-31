<template>
    <div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row m--margin-bottom-15">
                    <div class="col-sm-12 col-xs-12">

                        <div v-show="success" class="alert alert-success alert-dismissible">
                            <a class="close" @click="success=!success"></a>
                            <strong>Success!</strong>
                        </div>


                    </div>
                    <div class="col-sm-12 col-xs-12">
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
                        <td class="text-left"><span>{{career.description}}</span></td>
                        <td><span>{{milestoneLength(career['milestones'])}}</span></td>
                        <td><span class="btn btn-success" @click="editCareerTemplate(career, index)">Edit </span></td>
                        <td><span><button type="button"
                                          class="btn btn-danger" @click="deleteCareer(career.career_role_id, index)">Delete</button></span>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <modal v-if="showModal">


            <h3 slot="header">
                {{placeHolderTask}}
            </h3>

            <div slot="body" class="">
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row" v-if="!updatingMilestone"><label for="careerTask"
                                                                                               class="col-sm-3 col-xs-12  col-form-label">Career
                        Task</label>
                        <div class="col-sm-9 col-xs-12 "><input v-model="careerTaskTitle" required=""
                                                                name="CareerName" type="text"
                                                                id="careerTask"
                                                                placeholder="Career Task"
                                                                class="form-control m-input"
                        ></div>
                    </div>
                    <div class="form-group m-form__group row" v-if="!updatingMilestone"><label for="careerDescription"
                                                                                               class="col-sm-3 col-xs-12 col-form-label">Description</label>
                        <div class="col-sm-9 col-xs-12"><textarea style="min-height: 200px" required="" maxlength="3000"
                                                                  id="careerDescription"
                                                                  rows="3" class="form-control m-input"
                                                                  v-model="careerDescription"
                                                                  name="description"></textarea></div>
                    </div>

                    <div v-show="updatingMilestone">
                        <div class="m-portlet__body">

                            <div class="form-group m-form__group row m--margin-top-15"><label for="updateMilestone"
                                                                                              class="col-sm-3 col-xs-12  col-form-label">Update
                                Milestone</label>
                                <div class="col-sm-9 col-xs-12 "><input v-model="updateMilestoneName" required=""
                                                                        name="uMilestoneName" type="text"
                                                                        placeholder="Milestone Name"
                                                                        id="updateMilestone"
                                                                        maxlength="30"
                                                                        class="form-control m-input"></div>
                            </div>
                            <div class="form-group m-form__group row m--margin-top-15"><label
                                    for="updateMilestoneDescription"
                                    class="col-sm-3 col-xs-12  col-form-label">Update milestone
                                description</label>
                                <div class="col-sm-9 col-xs-12 "> <textarea v-model="updateMilestoneDescription"
                                                                            id="updateMilestoneDescription" rows="10"
                                                                            name="career_description"
                                                                            class="form-control m-input"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <div class="row">
                                    <div class="col-sm-3 col-xs-12">
                                        <button @click="deleteCareerMilestone(currentCareerRoleMilestoneId,currentMilestoneIndex)"
                                                class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill">
                                            <i
                                                    class="icon flaticon-delete-1"></i></button>

                                    </div>
                                    <div class="col-sm-9 col-xs-12">
                                        <div class="profile-timeline__action">

                                            <button @click="cancelMilestoneEdit" type="button"
                                                    class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">
                                                Cancel
                                            </button>
                                            <button type="submit"
                                                    @click="editCareerMilestone()"
                                                    class="btn btn-success m-btn m-btn--pill">
                                                <span><span>Save</span></span></button>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-show="!updatingMilestone">
                        <div class="form-group m-form__group row m--margin-top-15"><label for="milestoneName"
                                                                                          class="col-sm-3 col-xs-12  col-form-label">Milestone</label>
                            <div class="col-sm-9 col-xs-12 "><input v-model="newMilestoneName" required=""
                                                                    name="milestoneName" type="text"
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
                                            <button @click="createMilestone(newMilestoneName)" type="button"
                                                    class="btn m-btn--pill btn-success m-btn m-btn--custom">New
                                                Milestone
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label for="Milestones" class="col-3 col-form-label">Milestones:</label>
                            <div class="col-9" id="Milestones">
                                <ul :style="'listStyleType:none'">
                                    <li v-for="(milestone, index) in careerMilestones" :key="index" :index="index">

                                        <span>{{milestone.task}}</span>

                                        <div class="profile-timeline__milestones--action">
                                            <a @click="updateMilestone(milestone, index)" tabindex=""
                                               class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill m--margin-left-10">
                                                <i class="la la-pencil-square"></i></a>
                                        </div>


                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div slot="footer" class="m-portlet__foot m-portlet__foot--fit m--margin-top-10">
                <div v-show="!updatingMilestone">
                    <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom m--margin-5"
                            @click="clearModalData">Cancel
                    </button>
                    <button type="submit" class="btn m-btn--pill btn-success m--margin-5" @click="updateCareer">Submit
                    </button>
                </div>
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
                updatingMilestone: false,

                newMilestoneName: null,
                updateMilestoneName: null,
                updateMilestoneDescription: null,
                currentMilestoneIndex: null,
                currentCareerRoleMilestoneId: null


            }
        },
        computed: {},
        methods: {
            editCareerMilestone() {

                if (this.updateMilestoneName) {

                    const data = {
                        careerMilestoneTask: this.updateMilestoneName,
                        careerMilestoneDescription: this.updateMilestoneDescription,
                    };

                    axios.patch('admin/career-template/list/milestone/' + this.currentCareerRoleMilestoneId, data).then(response => {
                        if (response.status === 200) {

                            this.careers[this.currentIndex]['milestones'][this.currentMilestoneIndex].task = response.data.task;
                            this.careers[this.currentIndex]['milestones'][this.currentMilestoneIndex].description = response.data.description;
                            this.cancelMilestoneEdit();
                        }
                    });
                }
            },
            deleteCareerMilestone() {

                axios.delete('admin/career-template/list/milestone', {params: {careerMilestoneId: this.currentCareerRoleMilestoneId}}).then(response => {
                    if (response.status === 200) {
                        this.careers[this.currentIndex]['milestones'].splice(this.currentMilestoneIndex, 1);
                        this.cancelMilestoneEdit();
                    }
                })

            },

            cancelMilestoneEdit() {
                this.updatingMilestone = false;
                this.updateMilestoneName = null;
                this.updateMilestoneDescription = null;
                this.currentCareerRoleMilestoneId = null;
                this.currentMilestoneIndex = null;
            },

            updateMilestone(milestone, index) {

                this.currentMilestoneIndex = index;
                this.updatingMilestone = true;
                this.updateMilestoneName = milestone.task;
                this.updateMilestoneDescription = milestone.description;
                this.currentCareerRoleMilestoneId = milestone.careerRoleMilestoneId;
            },

            deleteCareer(careerId, index) {


                let confirmation = confirm("Are you sure you want to delete this Career Template?");

                if (confirmation) {

                    axios.delete('admin/career-template/list/', {params: {careerId: careerId}}).then(response => {
                        if (response.status === 200) {
                            this.careers.splice(index, 1);
                            this.success = true;
                        }
                    })
                }


            },

            createMilestone() {
                if (this.newMilestoneName) {
                    const data = {
                        careerMilestoneTask: this.newMilestoneName
                    };
                    this.newMilestoneName = null;

                    axios.post('admin/career-template/list/milestone/' + this.careerRoleId, data).then(response => {
                        if (response.status === 200) {
                            this.careers[this.currentIndex]['milestones'].push({
                                careerRoleMilestoneId: response.data.careerRoleMilestoneId,
                                task: response.data.task
                            });


                        }
                    }).catch(response => {

                    });


                }
            },

            milestoneLength(milestones) {
                return milestones.length;
            },
            clearModalData() {
                if (this.showModal) {
                    this.currentCareerRoleMilestoneId = null;
                    this.updateMilestoneName = null;
                    this.updateMilestoneDescription = null;
                    this.careerTaskTitle = null;
                    this.careerDescription = null;
                    this.careerMilestones = null;
                    this.careerRoleId = null;
                    this.currentIndex = null;
                    this.placeHolderTask = null;
                    this.newMilestoneName = null;
                    this.updatingMilestone = false;
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

                    axios.patch('admin/career-template/list/' + this.careerRoleId, data).then(response => {
                        if (response.status === 200) {
                            this.careerList[this.currentIndex].task = response.data.title;
                            this.careerList[this.currentIndex].description = response.data.description;


                            this.clearModalData();

                            this.success = true;

                        }

                    });

                }

            }

        }
    }
</script>

<style scoped>

</style>