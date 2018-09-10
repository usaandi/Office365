<template>
    <div>
        <v-select taggable push-tags
                  v-model="selected"
                  :options="departments"
                  @option:created="updateOptions"
                  @input="selectedValue"
        ></v-select>
        <button @click="onClick">Cancel</button>
        <button @click="submit">Save</button>
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
                this.selected = { label: this.userdata.department, value: this.userdata.department_id };
            }
        },
        data() {
            return {
                selected: null,
                departments: [],
                selectedDepartmentName:'',
            }
        },
        created() {
            this.selected = { label: this.userdata.department, value: this.userdata.department_id };
            this.fetchData();
        },
        methods:{

            onClick (event) {
                this.$emit('close','false')
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

            submit: function(){
                let vm = this;
                this.onClick();
                axios.post('/user/'+ this.userdata.id + '/department', {data: this.selectedDepartmentName})
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