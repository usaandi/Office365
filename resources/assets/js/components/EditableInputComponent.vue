<template>
    <div>
        <div class="profile__form profile__form--clear ">

            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <div class="col-9">
                        <input v-model="elementdata" @keyup.enter="upload" type="text"
                               class="form-control m-input">
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12"></div>
                            <div class="col-sm-9 col-xs-12 m--margin-5">
                                <div class="profile-timeline__action ">
                                    <button @click="cancel()" type="button"
                                            class="btn m-btn--pill btn-success m-btn m-btn--custom">Cancel
                                    </button>
                                    <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom"
                                            @click="upload()">Save
                                    </button>
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
        name: "EditableInputComponent",
        props: ['endpoint', 'elementName', 'data'],

        data() {
            return {
                elementdata: null,
                edit: true,
                showinput: false,
            }
        },
        mounted() {
            this.elementdata = this.data;
        },
        methods: {

            cancel: function () {
                this.$emit('canceled');
            },

            upload: function () {

                let vm = this;
                axios.post(this.endpoint, {data: this.elementdata}).then(response => {
                    vm.$emit('input-updated', vm.elementdata);
                });
            },
        }

    }
</script>
<style>

</style>