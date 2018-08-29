<template>
    <div>
        <v-select taggable push-tags
                  label="department_name"
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
        props: ['userid','canedit'],
        data() {
            return {

                id: '',
                departments: [],
                department:'',
                departmentId:'',
                test:false,

            }
        },
        mounted() {
            this.id = this.userid;
            this.fetchData();
        },
        methods:{

            fetchData: function () {
                axios.get('/departmentInfo')
                    .then(response => {
                        this.departments = response.data;
                    });
            },

            submit: function(){
                let vm =this;
                axios.post('/user/'+ this.id + '/department', {data: this.department.department_name})
                    .then(response => {
                        vm.$emit('select-updated', vm.department.department_name);
                        vm.department = '';
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