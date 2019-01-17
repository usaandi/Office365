<template>
    <div>
        <div class="m-portlet__body">
            <div class="career__note--border m--margin-bottom-15" style="padding: 10px 10px 0">
                <div class="row ">
                    <div class="col-lg-12 col-sm-12  ">
                        <div class="m--margin-20">

                            <div v-show="edit">
                                <div>
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row"><label
                                                for="title"
                                                class="col-lg-1 col-sm-3 col-xs-12 col-form-label">Title</label>
                                            <div class="col-lg-11"><input id="title" type="text"
                                                                         name="title" placeholder="Title"
                                                                         class="form-control m-input"></div>
                                        </div>
                                        <div class="form-group m-form__group row"><label
                                                for="description"
                                                class=" col-1 col-form-label">Description</label>
                                            <div class="col-sm-9 col-xs-12 col-lg-11"><textarea
                                                    id="description" rows="10"
                                                    name="career_description"
                                                    class="form-control m-input"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            <div class="row">
                                                <div class="col-sm-3 col-xs-12 col-lg-2">
                                                    <button
                                                            class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill">
                                                        <i class="icon flaticon-delete-1"></i></button>
                                                </div>
                                                <div class="col-sm-9 col-xs-12 col-lg-10">
                                                    <div class="profile-timeline__action">
                                                        <button type="button" @click="edit=!edit"
                                                                class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">
                                                            Close
                                                        </button>
                                                        <button type="submit"
                                                                class="btn btn-success m-btn m-btn--pill"><span><span
                                                        >Submit</span></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-show="!edit">
                                <div class="career__note--title">Q12 Tagasiside</div>
                                <div class="m--margin-bottom-5 career__note--info">
                                    <div class="career__note--info__date m--margin-right-10">
                                        01.01.2007
                                    </div>
                                    <div class="career__note--info__assigner">Ain Arend</div>
                                </div>

                                <p>{{description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-timeline__action m--margin-15" v-show="!edit">
                    <button class="btn m-btn--pill btn-outline-success m-btn m-btn--custom m--margin-10"
                            @click="edit=!edit">Edit
                    </button>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
    export default {
        name: "CareerNotes",
        data: () => ({
            edit: false,
            description: 'fdkjasfdais Lorem ipsum dolor sit amet, ' +
                'consectetur adipiscing elit. fdkjasfdais Lorem ipsum dolor sit amet, ' +
                'consectetur adipiscing elit. fdkjasfdais Lorem ipsum dolor sit amet,' +
                ' consectetur adipiscing elit. fdkjasfdais Lorem ipsum dolor sit amet, ' +
                'consectetur adipiscing elit. Aenean euismod',

        }),
        async created() {


        }
    }
</script>

<style scoped>

</style>