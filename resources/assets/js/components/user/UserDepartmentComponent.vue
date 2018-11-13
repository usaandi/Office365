<template>
    <div>
        <v-select taggable push-tags
                  v-model="selected"
                  :options="departments"
                  @option:created="updateOptions"
                  @input="selectedValue"
        ></v-select>
        <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-10">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-sm-3 col-xs-12"></div>
                    <div class="col-sm-9 col-xs-12">
                        <div class="profile-timeline__action">
                            <button @click="onClick()" type="button"
                                    class="btn m-btn--pill btn-success m-btn m-btn--custom">Cancel
                            </button>
                            <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom"
                                    @click="submit()">Save
                            </button>
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
            'userdata': {
                required: true
            }
        },
        watch: {
            userdata: function (val) {
                this.userdata = val;
                this.selected = {label: this.userdata.department, value: this.userdata.department_id};
            }
        },
        data() {
            return {
                selected: null,
                departments: [],
                selectedDepartmentName: '',
            }
        },
        created() {
            this.selected = {label: this.userdata.department, value: this.userdata.department_id};
            this.fetchData();
        },
        methods: {

            onClick() {
                this.$emit('close', 'false')
            },

            fetchData: function () {
                axios.get('/departmentInfo')
                    .then(response => {
                        let departmentOptions = [];
                        for (let i = 0; i < response.data.length; i++) {
                            const data = response.data[i];
                            departmentOptions[departmentOptions.length] = {
                                label: data.department_name,
                                value: data.id,
                            }
                        }
                        this.departments = departmentOptions;
                    });
            },

            submit: function () {
                let vm = this;
                this.onClick();
                axios.post('/user/' + this.userdata.id + '/department', {data: this.selectedDepartmentName})
                    .then(response => {
                        vm.$emit('select-updated', vm.selectedDepartmentName);
                    });

            },
            updateOptions(newOption) {
                this.department = newOption;

            },

            selectedValue(value) {
                this.selectedDepartmentName = value.label;
                this.department = value;
                this.departmentId = this.department.id;
            }

        }

    }
</script>

<style scoped>

</style>