<template>
    <div>
        <div class="profile-timeline">
            <div class="m-timeline-2">
                <div class="m-timeline-2__items">
                    <div class="m-timeline-2__item">
                        <span class="m-timeline-2__item-time">2020 Jan</span>
                        <div class="m-timeline-2__item-cricle">
                            <i class="fa fa-genderless m--font-info"></i>
                        </div>
                        <div class="m-timeline-2__item-text  m--padding-top-5">
                            <div class="profile-timeline__content">
                                <div class="row">
                                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                                        <h4 class="profile-timeline__title">FINAL BOSS</h4>
                                    </div>
                                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                                        <p class="profile-timeline__text">
                                            Coordinate with designers and developers to develop various new products and features along with various interactive designs
                                            within required timeframe. Develop new business initiatives in coordination with UE team and
                                            design various methodologies and practices for innovative interactive technologies and perform
                                            quality assurance and browser computability tests. Design style sheets for website and assist
                                            application programmers in effective implementation and ensure all work according to scripting
                                            code with help of various technologies. Collaborate with designers and application developer
                                            to develop various customized websites. Prepare all production documents on Photoshop and translate
                                            same into HTML templates with help of developers and designers and facilitate to introduce new
                                            features into same.
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                                        <h4 class="profile-timeline__title">MILESTONES</h4>
                                    </div>
                                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                                        <div class="profile-timeline__add">
                                            <a href="#" class="btn btn-success m-btn m-btn--icon m-btn--pill">
                              <span>
                                <i class="la la-plus"></i>
                                <span>New</span>
                              </span>
                                            </a>
                                            <div class="profile-timeline__form">
                                                <form class="m-form">
                                                    <div class="m-portlet__body">
                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input" class="col-3 col-form-label">Task</label>
                                                            <div class="col-9">
                                                                <input type="text" class="form-control m-input" placeholder="Task">
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input" class="col-3 col-form-label">Assign</label>
                                                            <div class="col-9">
                                                                <select class="form-control m-input" id="exampleSelect1">
                                                                    <option>me</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input" class="col-3 col-form-label">Set reminder</label>
                                                            <div class="col-9">
                                                                <input type="date" class="form-control m-input" placeholder="Task">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                                        <div class="m-form__actions">
                                                            <div class="row">
                                                                <div class="col-sm-3 col-xs-12">
                                                                </div>
                                                                <div class="col-sm-9 col-xs-12">
                                                                    <div class="profile-timeline__action"><button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Cancel</button>
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
                                <div class="row">
                                    <div class="col-sm-3 col-md-3 col-lg-2 col-xs-12">
                                        <div class="profile-timeline__notes">
                                        </div>
                                    </div>
                                    <div class="col-sm-9 col-md-9 col-lg-10 col-xs-12">
                                        <div class="profile-timeline__action">
                                            <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Edit</button>
                                            <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom">Apply as current</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "CareerModal",
        data(){
            return{
                isHidden:false,

            }
        },

    }
</script>

<style scoped>
.cool-border{
    border: 1px solid #e1e1e1;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>