<template>
    <div>
        <div class="profile__form">

            <div class="m-portlet__body">
                <div class="form-group m-form__group row">

                    <label class="col-3 col-form-label">Hobby Name</label>
                    <div class="col-9">
                        <input @change="hobbyNameChange" v-model="hobbyName" :class="classObject" type="text"
                               placeholder="Hobby" class="form-control m-input">
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12"></div>
                        <div class="col-sm-9 col-xs-12">
                            <div class="profile-timeline__action">
                                <a @click="$emit('close')" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>Close</span>
                                    </span>
                                </a>
                                <a @click="submit()" tabindex="" class="btn btn-success m-btn m-btn--icon m-btn--pill">
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
        name: "UserHobbyForm",
        data() {
            return {
                hobbyName: '',
                hasError: false,
            }
        },
        methods: {

            hobbyNameChange() {

                if (this.hasError) {

                    this.hasError = false;
                }
            },
            submit() {

                if (this.hobbyName !== '') {

                    this.$emit('hobbyName', this.hobbyName);
                    this.hasError = false;
                    this.hobbyName = '';

                }
                else {
                    this.hasError = true;
                }
            }
        },
        computed: {
            classObject() {
                return {
                    'border border-danger': this.hasError,
                }

            },
        }
    }
</script>

<style scoped>

</style>