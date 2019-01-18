<template>
    <div>
        <div class="m-portlet__body">
            <career-note v-show="!show" v-for="(note, index) in notes "
                         :propNote="note"
                         :key="index"
                         :index="index"
                         @update="startUpdate($event)"
            ></career-note>
            <div v-show="show">
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
                                    <button type="button" @click="closeNoteEditView()"
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
    </div>
    </div>
</template>

<script>
    export default {
        props: {
            notes: {
                required: true
            },
        },
        name: "CareerNotes",
        data() {
            return {
                activeNote: null,
                activeIndex: null,
                show: false,
            }
        },
        computed: {},
        watch: {
            activeNote() {

            }
        },
        methods: {
            closeNoteEditView() {
                this.activeNote = null;
                this.show = false;

            },
            startUpdate(index) {

                this.activeNote = this.notes[index];
                this.show = true;

                console.log(index)
            }
        }

    }
</script>

<style scoped>

</style>