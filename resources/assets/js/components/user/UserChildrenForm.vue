<template>
    <div>
        <div class="profile__form">
            <form class="m-form">
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row"><label  class="col-3 col-form-label">Year born</label>
                        <div class="col-9">
                            <div class="input-group date">
                                <input type="text" class="form-control m-input datepicker" data-provide="datepicker" readonly="" placeholder="Select date" id="m_datepicker_2">
                                <div class="input-group-append">
                                              <span class="input-group-text">
                                   <i class="la la-calendar-check-o"></i>
                                  </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  class="form-group m-form__group row"><label  class="col-3 col-form-label">Child name</label>
                        <div class="col-9"><input type="text" placeholder="Child name" class="form-control m-input"></div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12"></div>
                            <div class="col-sm-9 col-xs-12">
                                <div class="profile-timeline__action">
                                    <a href="#" class="btn btn-success m-btn m-btn--icon m-btn--pill">
                                            <span>
                                          <i class="la la-plus"></i>
                                          <span>Add new</span>
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserChildrenForm"
    }
</script>

<style scoped>

</style>