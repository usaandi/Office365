<template>
    <div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row m--margin-bottom-15">
                    <div class="col-sm-12 col-xs-12">
                        <div class="alert alert-success alert-dismissible" style="display: none;"><a
                                class="close"></a> <strong>Success!</strong></div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="profile-timeline__action "><a
                                tabindex="0"
                                @click="noteCreate()"
                                class="btn btn-success m-btn m-btn--icon m-btn--pill "><span
                        ><i class="la la-plus"></i> <span
                        >Add Career Template</span></span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <career-note v-show="!show" v-for="(note, index) in sortArray(notesList)"
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
                                                      class="form-control m-input" v-model.trim="noteTitle"></div>
                    </div>
                    <div class="form-group m-form__group row"><label
                            for="description"
                            class=" col-1 col-form-label">Description</label>
                        <div class="col-sm-9 col-xs-12 col-lg-11"><textarea
                                id="description" rows="10"
                                name="career_description"
                                placeholder="Description"
                                class="form-control m-input" v-model.trim="noteDescription"></textarea>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12 col-lg-2">
                                <button v-show="!creating"
                                        class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill">
                                    <i class="icon flaticon-delete-1"></i></button>
                            </div>
                            <div class="col-sm-9 col-xs-12 col-lg-10">
                                <div class="profile-timeline__action" v-show="!creating">
                                    <button type="button" @click="closeNoteView()"
                                            class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">
                                        Close
                                    </button>
                                    <button type="submit" @click="submit()"
                                            class="btn btn-success m-btn m-btn--pill"><span><span
                                    >Submit</span></span></button>
                                </div>

                                <div class="profile-timeline__action" v-show="creating">
                                    <button type="button" @click="closeNoteView()"
                                            class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">
                                        Close
                                    </button>
                                    <button type="submit" @click="noteCreate()"
                                            class="btn btn-success m-btn m-btn--pill"><span><span
                                    >Create</span></span></button>
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

    import axios from 'axios';

    export default {
        props: {
            notes: {
                required: true
            },
            careerId: {
                required: true,
                text: 'career id',
            }
        },
        name: "CareerNotes",
        data() {
            return {

                notesList: this.notes,
                activeNote: null,
                activeIndex: null,
                creating: false,
                show: false,
                noteDescription: null,
                noteTitle: null,
                currentIndex: null,
                assignerId: null,

            }
        },
        computed: {},
        watch: {
            activeNote() {

            }
        },

        methods: {

            sortArray(array) {
                return _.orderBy(array, 'id','desc');
            },

            noteCreate() {
                this.creating = true;
                this.show = true;
                if (this.checkIfEmpty()) {
                    const data = {
                        noteDescription: this.noteDescription,
                        noteTitle: this.noteTitle
                    };

                    axios.post('/career/note/' + this.careerId, data).then(response => {
                        if (response.status === 200) {
                            this.notesList.push(response.data);
                            this.closeNoteView();
                        }

                    })
                }
            },
            closeNoteView() {
                this.activeNote = null;
                this.noteDescription = null;
                this.noteTitle = null;
                this.currenIndex = null;
                this.assignerId = null;
                this.creating = false;
                this.show = false;

            },
            startUpdate(index) {

                this.currenIndex = index;
                this.activeNote = this.notes[this.currenIndex];
                this.assignerId = this.activeNote.assigner_id;
                this.noteDescription = this.activeNote.description;
                this.noteTitle = this.activeNote.title;

                this.show = true;

            },
            checkIfEmpty() {

                if (this.noteDescription && this.noteTitle) {

                    return true
                }

                return false
            },
            submit() {
                if (this.checkIfEmpty()) {

                    const data = {
                        noteDescription: this.noteDescription,
                        noteTitle: this.noteTitle
                    };


                    axios.patch(this.activeNote.id, data).then(response => {
                        if (response.status === 200) {
                            this.notesList[this.currenIndex].title = response.data.title;
                            this.notesList[this.currenIndex].description = response.data.description;
                            this.closeNoteView();
                        }
                    });


                }
            }
        }

    }
</script>

<style scoped>

</style>