<template>
    <div class="career__note--border m--margin-bottom-15" style="padding: 10px 10px 0">
        <div class="row ">
            <div class="col-lg-12 col-sm-12">
                <div class="m--margin-20">
                    <div>
                        <div class="career__note--title">{{note.title}}</div>
                        <div class="m--margin-bottom-5 career__note--info">
                            <div class="career__note--info__date m--margin-right-10">
                                {{note.created_at}}
                            </div>
                            <div class="career__note--info__assigner">{{note.assigner_name}}</div>
                        </div>

                        <p class="profile-timeline__text">{{note.description}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-timeline__action m--margin-15">
            <button class="btn m-btn--pill btn-outline-success m-btn m-btn--custom m--margin-10"
                    @click="emitEdit(index)"
            >Edit
            </button>
        </div>
    </div>
</template>

<script>

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
                note: this.propNote

            }
        },
        methods: {
            emitEdit(index) {
                this.$emit('update', index);
            }
        }
    }
</script>

<style scoped>

</style>