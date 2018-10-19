<template>
    <div>
        <div class="profile__form profile__form--clear">

                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label for="ElementName" class="col-3 col-form-label">
                            {{elementName }}</label>
                        <div class="col-9">
                            <input v-model="elementdata" @keyup.enter="upload" type="text"
                                   placeholder="ElementName" class="form-control m-input">
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12"></div>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="profile-timeline__action">
                                        <button @click="upload" class="btn btn-success m-btn m-btn--pill">
                                            <span><span>Save</span></span></button>
                                        <button
                                                @click="cancel" class="btn btn-danger m-btn m-btn--pill">
                                            <span><span>Cancel</span></span></button>
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