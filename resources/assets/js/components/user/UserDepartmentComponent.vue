<template>
    <div>
        <v-select taggable push-tags
                  v-model="selected"
                  :options="departments"
                  @option:created="updateOptions"
                  @input="selectedValue"
                  @keydown.native.enter="submit()"
        ></v-select>
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
                id: '',
                selected: null,
                departments: [],
            }
        },
        created() {
            this.id = this.userdata.id;
            this.selected = { label: this.userdata.department, value: this.userdata.department_id };
            this.fetchData();
        },
        methods:{

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
                axios.post('/user/'+ this.id + '/department', {data: this.department.department_name})
                    .then(response => {
                        vm.$emit('select-updated', vm.department.department_name);
                    });

            },
            updateOptions(newOption) {
                this.department = newOption;

            },

            selectedValue(value) {
                this.department = value;
                this.departmentId = this.department.id;
                this.submit();
            }

        }

    }
</script>

<style scoped>

</style>