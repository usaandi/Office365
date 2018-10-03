<template>
    <div>
        <div class="profile__form">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-3 col-form-label">Hobbie</label>
                    <div class="col-9"><input type="text" placeholder="Hobbie" class="form-control m-input"></div>
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
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserHobbyForm"
    }
</script>

<style scoped>

</style>