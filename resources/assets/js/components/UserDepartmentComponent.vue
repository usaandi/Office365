<template>
    <div>
        <p class="text"><b>DEPARTMENT:</b>
        <v-select taggable push-tags
                  label="department_name"
                  :options="departments"
                  :closeOnSelect="true"
                  @option:created="updateOptions"
                  @input="selectedValue"
                  @keydown.native.enter="submit()"
        ></v-select>

        <div>
        <p></p>
            <v-select>

            </v-select>
        </div>

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
                teams:[],

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
                axios.post('/user/'+ this.id + '/team', {data: this.department.department_name})
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
                this.submit();
            }

        }
    }
</script>

<style scoped>

</style>