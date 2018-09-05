<template>
<div>
    <div class="row">

        <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
            <h4 class="profile-timeline__title">MILESTONES</h4>
        </div>
        <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
            <div class="profile-timeline__add">
                <a v-show="!show" @click="show=!show" class="btn btn-success m-btn m-btn--icon m-btn--pill">
                                              <span>
                                                <i class="la la-plus"></i>
                                                <span>New</span>
                                              </span>
                </a>
                <div v-show="show" class="profile-timeline__form">
                    <form class="m-form">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <label for="Task" class="col-3 col-form-label">Task</label>
                                <div class="col-9">
                                    <input id="Task" class="form-control m-input" placeholder="Task">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="Assign" class="col-3 col-form-label">Assign</label>
                                <div class="col-9">
                                    <select class="form-control m-input" id="Assign">
                                        <option>me</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label for="Reminder" class="col-3 col-form-label">Set reminder</label>
                                <div class="col-9">
                                    <input type="date" id="Reminder" class="form-control m-input" placeholder="Task">
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <div class="row">
                                    <div class="col-sm-3 col-xs-12">
                                    </div>
                                    <div class="col-sm-9 col-xs-12">
                                        <div class="profile-timeline__action"><button @click="show=!show" type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Cancel</button>
                                            <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom">Save</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="profile-timeline__milestone">
                <div class="m-form__group form-group">
                    <div class="m-checkbox-list">
                        <label class="m-checkbox m-checkbox--air m-checkbox--state-success">
                            <input type="checkbox"> <div class="profile-timeline__milestones--label">CSS Masterclass Course</div>
                            <span></span>
                            <div class="profile-timeline__milestones--name">
                                <div class="m-list-pics m-list-pics--sm">
                                    <a href="#"><img src="" title=""></a>
                                    Tiina-Maria Liblikas
                                </div>
                            </div>
                            <div class="profile-timeline__milestones--date m--font-danger">
                                12.12.18
                            </div>
                            <div class="profile-timeline__milestones--action">
                                <a href="#" class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill">
                                    <i class="la la-pencil-square"></i>
                                </a>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
</template>

<script>
    export default {
        name: "CareerMilestone",
        data(){
            return {
               show:false,
            }
        },
    }
</script>

<style scoped>

</style>