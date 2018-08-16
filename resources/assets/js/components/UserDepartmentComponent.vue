<template>
    <div>
        <div>
            <v-select taggable push-tags
                      label="department_name"
                      :options="departments"
                      :closeOnSelect="true"
                      @option:created="updateOptions"
                      @input="selectedValue"
                      @keydown.native.enter="submit()"
            ></v-select>
            <div>
                <p>{{foo}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "DepartmentUserList",
        props: ['userid','canedit'],
        data() {
            return {
                id: '',
                departments: [],
                foo:'',
                edit: 'false'
            }
        },
        mounted() {
            this.id = this.userid;
            this.fetchData();
        },
        methods:{

            fetchData: function () {
                axios.get('http://localhost/departmentInfo')
                    .then(response => {
                        this.departments = response.data;
                    });
            },

            submit: function(){
                let vm =this;
                axios.post('/user/'+ this.id + '/team', {data: this.foo.department_name})
                    .then(response => {
                        vm.foo = '';
                        console.log(response.data)
                    });

            },

            upload: function () {
                let vm = this;
                axios.post('http://localhost/user/' + this.id + '/update/hobby',{data: this.hobbyname})
                    .then(response => {
                        vm.userhobbies.push({
                            id: response.data.user_hobby_id,
                            hobby_name: response.data.hobby_name
                        });
                        vm.edit = false;
                    }).catch(error => {
                    console.log(error.response.data);
                });
            },

            updateOptions(newOption) {
                this.foo = newOption;
            },

            selectedValue(value) {
                this.foo = value;
                this.submit();
            }

        }
    }
</script>

<style scoped>

</style>