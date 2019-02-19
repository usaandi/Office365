<template>
    <div class="career__note--border m--margin-bottom-15" style="padding: 10px 10px 0">
        <div class="row ">
            <div class="col-lg-12 col-sm-12">
                <div class="m--margin-20">
                    <div>
                        <div class="career__note--title">{{propNote.title}}</div>
                        <div class="m--margin-bottom-5 career__note--info">
                            <div class="career__note--info__date m--margin-right-10">
                                {{propNote.created_at}}
                            </div>
                            <div class="career__note--info__assigner">{{propNote.assigner_name}}</div>
                        </div>

                        <p class="profile-timeline__text">{{propNote.description}}</p>
                    </div>
                </div>

            </div>

        </div>
        <div class="profile-timeline__action m--margin-15 career__note--control">
            <label v-show="canEditState()" style="position:relative " class="hover-over">
                <div class="myStyle">{{textBox}}</div>
                <i class="fas fa-2x icon-style" :class="lockType">
                </i>

                <input @change="setPublicState(propNote.is_public)"
                       v-model="propNote.is_public"
                       type="checkbox" class="m--hide">
            </label>

            <button class="btn m-btn--pill btn-outline-success m-btn m-btn--custom m--margin-10" v-show="canEdit()"
                    @click="emitEdit(index)"
            >Edit
            </button>

        </div>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        props: {
            propNote: {
                required: true
            },
            index: {
                required: true
            },

        },
        name: "CareerNote",
        data() {
            return {
                note: this.propNote,
                admin: isAdmin,
                authUserId: authUser.id,
                textBoxText: null,

            }
        },
        computed: {
            lockType() {
                return {
                    'fa-lock': !this.note.is_public,
                    'fa-lock-open': this.note.is_public
                }
            },
            textBox() {
                return this.note.is_public ? this.textBoxText = 'Public' : this.textBoxText = 'Only i can see this note';
            },
        },
        watch: {},
        methods: {
            emitEdit(index) {
                this.$emit('update', index);
            },
            canEditState() {
                if (this.note.assigner_id === this.authUserId) {
                    return true
                }
                return false
            },

            canEdit() {

                if (this.note.assigner_id === this.authUserId) {
                    return true;
                }
                return false;
            },

            setPublicState(state) {
                const data = {is_public: state};

                axios.patch('/note/update-status/' + this.note.id, data).then(response => {
                })

            }
        }
    }
</script>

<style scoped>


</style>