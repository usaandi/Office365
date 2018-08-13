<template>
    <div>
        <h3>Users</h3>
        <draggable v-model="users">
            <div class="users" v-for="user in users">
                {{ user.name }}
            </div>
        </draggable>
        <h3>Departments: {{ departments.length }}</h3>
        <div class="deps" v-for="department in departments">
            <h4>{{ department.department_name }}</h4>
            <draggable v-model="department.users" :options="{group:'users'}" style="min-height: 15px">
                <div class="users" v-for="user in department.users">
                    {{ user.name }}
                </div>
            </draggable>
        </div>
    </div>
</template>

<script>

    import draggable from 'vuedraggable';
    import axios from 'axios';

    export default {

        components: {
            draggable,
        },
        props: [],
        name: "DepartmentUserListDraggable",

        data(){
            return{
                users:[],
                usersWithoutDepartment: [],
                departments:[],
            }
        },
        mounted(){
            this.fetchuser();
            let vm = this;
            setTimeout(function() {
                vm.departments = vm.fetchdepartment();
            }, 200);
            setTimeout(function() {
                vm.departments = vm.departments;
            }, 1000);
        },
        methods:{
            fetchuser: function () {
                let vm = this;
                axios.get('http://localhost/usersDepartment')
                    .then(response => {
                        vm.users = response.data;
                    });
            },
            fetchdepartment: function () {
                let vm = this;
                axios.get('http://localhost/departmentInfo')
                    .then(response => {
                        //this.departments = response.data;
                        let departmentData = {};

                        for (let i = 0; i < response.data.length; i++) {

                            departmentData = response.data[i];
                            departmentData.users = [];

                            for (let j = 0; j < vm.users.length; j++) {

                                if (vm.users[j].department_id === response.data[i].id) {
                                    departmentData.users[departmentData.users.length] = vm.users[j];
                                }
                            }
                            vm.departments[vm.departments.length] = departmentData;
                            departmentData = {};
                        }
                    });
                return vm.departments;
            },
        }
}

</script>

    <style scoped>

    </style>
