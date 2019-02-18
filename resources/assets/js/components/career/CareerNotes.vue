<template>
    <div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row m--margin-bottom-15">
                    <div class="col-sm-12 col-xs-12" v-show="success">
                        <div class="alert alert-success alert-dismissible text-center" style=""><a
                                @click="success=!success"
                                class="close"></a> <strong>Success!</strong></div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="profile-timeline__action "><a
                                tabindex="0"
                                @click="noteCreate()"
                                class="btn btn-success m-btn m-btn--icon m-btn--pill "><span
                        ><i class="la la-plus"></i> <span
                        >Create Note</span></span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <career-note v-show="!show" v-for="(note, index) in noteList"
                         :propNote="note"
                         :key="note.id"
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
                    <div class="form-group m-form__group row"><label
                            for="hidden"
                            class="col-form-label col-1 col-xs-12">Set Public</label>
                        <input id="hidden" type="checkbox" class="m--margin-left-15" v-show="false"
                               name="title"
                               v-model="setPublicState">
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12 col-lg-2">
                                <button v-show="!creating" @click="noteDelete"
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
                required: true,
                type: Array,
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
                creating: false,
                show: false,
                noteDescription: null,
                noteTitle: null,
                assignerId: null,
                noteId: null,
                index: null,
                success: false,
                setPublicState: false,


            }
        },
        computed: {

            noteList() {
                return this.notesList;
            },

        },
        watch: {
            activeNote() {
            }
        },
        mounted() {
        },


        methods: {
            noteDelete() {
                let confirmation = confirm('Are you sure? ' +
                    'you want to delete Note?');

                if (confirmation) {
                    axios.delete('/note/delete', {params: {id: this.noteId}}).then(response => {
                        if (response.status === 200) {
                            /*let index = this.notesList.map(note => note.id).indexOf(this.noteId);*/
                            let tmpList = this.notesList;
                            this.notesList = [];
                            tmpList.splice(this.index, 1);
                            this.notesList = tmpList;
                            this.closeNoteView();
                            this.success = true;
                        }

                    })
                }
                if (!confirmation) {
                    this.closeNoteView();
                }
            },
            checkIfEmpty() {

                if (this.noteDescription && this.noteTitle) {
                    return true
                }
                return false
            },

            noteCreate() {
                this.creating = true;
                this.show = true;
                if (this.checkIfEmpty()) {
                    const data = {
                        noteDescription: this.noteDescription,
                        noteTitle: this.noteTitle,
                        public: this.setPublicState,
                    };
                    axios.post('/career/note/' + this.careerId, data).then(response => {
                        if (response.status === 200) {

                            this.pushToNoteList(response.data);
                            this.closeNoteView();
                            this.success = true;
                        }

                    })
                }
            },
            closeNoteView() {
                this.show = false;
                this.activeNote = null;
                this.noteDescription = null;
                this.noteTitle = null;
                this.assignerId = null;
                this.creating = false;
                this.setPublicState = false;
                this.noteId = null;
                this.index = null;

            },

            pushToNoteList(data) {
                this.notesList.push(data);
            },
            startUpdate(index) {

                this.index = index;

                this.activeNote = this.notesList[index];
                this.assignerId = this.activeNote['assigner_id'];
                this.noteDescription = this.activeNote.description;
                this.noteTitle = this.activeNote.title;
                this.noteId = this.activeNote.id;

                this.show = true;

            },

            submit() {

                if (this.checkIfEmpty()) {

                    const data = {
                        noteDescription: this.noteDescription,
                        noteTitle: this.noteTitle
                    };
                    axios.patch(this.activeNote.id, data).then(response => {
                        if (response.status === 200) {
                            this.notesList[this.index].title = response.data.title;
                            this.notesList[this.index].description = response.data.description;
                            this.closeNoteView();
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