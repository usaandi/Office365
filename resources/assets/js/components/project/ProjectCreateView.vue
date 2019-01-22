<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="m-form__actions m--margin-top-15">
                    <div class="row">
                        <label for="projectName" class="col-xs-12 m--font-brand">
                            Project name
                        </label>
                        <input type="text" class="form-control col-xs-12" id="projectName"
                               placeholder="Project name"/>
                    </div>
                </div>
                <div class="m-form__actions m--margin-top-15">
                    <div class="row">
                        <label for="from" class="col-xs-12 col-lg-2 m--font-brand">Begin date</label>
                        <div class="input-group date col-lg-4" data-provide="datepicker">
                            <input type="text" class="form-control" id="from">
                            <div class="input-group-addon">
                            </div>
                        </div>
                        <label for="from" class="col-xs-12 col-lg-2 m--font-brand">End date</label>
                        <div class="input-group date col-lg-4" data-provide="datepicker">
                            <input type="text" class="form-control" id="from">
                            <div class="input-group-addon">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-form__actions m--margin-top-15">
                    <div class="row">
                        <label for="projectClient" class="col-xs-12 m--font-brand">
                            Client
                        </label>
                        <input type="text" class="form-control col-xs-12" id="projectClient"
                               placeholder="Client"/>
                    </div>
                </div>


                <div class="m-form__actions m--margin-top-15">
                    <div class="row">
                        <label for="description" class="col-xs-12 m--font-brand">Description</label>
                        <textarea id="description" class="form-control col-xs-12" rows="10"
                                  placeholder="Description"></textarea>
                    </div>
                </div>

                <div class="m-form__actions m--margin-top-15">
                    <div class="row">
                        <label for="button-addon6" class=" col-xs-12 m--font-brand">
                            Inimesed
                        </label>
                        <div class="input-group col-xs-12 position-relative">
                            <div class="form-control row-counter-15-l"> Ain Arend</div>
                            <div class="input-group-append" style="margin-right: 30px;" id="button-addon6">
                                <button class="btn m-btn--pill btn-outline-danger m-btn m-btn--custom"
                                        type="button">
                                    Remove
                                </button>
                                <button class="btn m-btn--pill btn-outline-warning m-btn m-btn--custom"
                                        type="button">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-form__actions m--margin-top-15">
                    <div class="row">
                        <label for="searchName" class="col-xs-12 m--font-brand">
                            Search People
                        </label>

                        <div class="input-group  col-xs-12 position-relative">
                            <input type="text" class="form-control " id="searchName"
                                   placeholder="Search People..."/>
                            <div class="input-group-append">
                                <button class="btn m-btn--pill btn-outline-info m-btn m-btn--custom" type="button">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-form__actions m--margin-top-15">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                            <a tabindex=""
                               class="btn m-btn--pill btn-outline-success m-btn m-btn--custom"><span><i
                                    class="la la-plus"></i> <span
                            >Add Peoples</span></span></a>
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <div class="profile-timeline__action">
                                <button type="button"
                                        class="btn m-btn--pill btn-outline-info m-btn m-btn--custom">Cancel
                                </button>
                                <button type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom"
                                >Save
                                </button>
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
        name: "ProjectCreateView"
    }
</script>

<style scoped>


</style>