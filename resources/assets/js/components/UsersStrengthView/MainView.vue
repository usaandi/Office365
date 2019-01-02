<template>
    <div class="">
        <table v-if="categories && departments" class="table table-bordered text-center table-responsive ">
            <thead>
            <tr>
                <th></th>
                <th v-for="category in categories" :colspan="category.strengths.length"
                    :style="{backgroundColor: category.category_colour}"
                    scope="colgroup"
                    :id="category.category_id">
                    <span>{{category.category_name}}</span>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td
                        v-for="strength in strengths"
                        :id="strength.strength_id"
                        :headers="strength.category_id"
                >
                    <span>{{strength.strength_name}}</span>
                </td>

            </tr>
            </tbody>
            <tbody v-for="department in departments">
            <tr>
                <th :id="department.department_id" scope="colgroup"><span>{{department.department_name}}</span></th>
            </tr>
            <tr v-for="user in department.users">
                <td><span>{{ user.user_name }}</span></td>
                <td v-for="strength in strengths" :style="backGroundColor(strength , user.strengths)"><span
                        :style="strengthColor(strength ,user.strengths)">{{checkStrength(strength, user.strengths)}}</span>
                </td>
            </tr>
            </tbody>
        </table>
        <div v-if="departments === null && categories === null" class="text-center text-body m--font-bold">
            There is no information about Departments and Users
        </div>


    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "department",
        data() {


            return {
                categories: '',
                departments: '',
                strengths: [],
                styleText: {
                    color: 'white',
                    fontWeight: 'bold',

                },
                styleBackground: {
                    backgroundColor: '#009eed',
                }
            }
        },
        mounted() {

            this.fetchCategories();
            this.fetchDepartment();

        },
        computed: {},
        methods: {

            backGroundColor(strength, userStrengths) {

                if (userStrengths.length > 0) {
                    for (let i = 0; i < userStrengths.length; i++) {
                        if (strength.strength_id === userStrengths[i].strength_id) {
                            if (userStrengths[i].strength_rank < 6) {
                                return this.styleBackground;
                            }
                        }
                    }
                    return ''
                }

            },
            strengthColor(strength, userStrengths) {

                if (userStrengths.length > 0) {
                    for (let i = 0; i < userStrengths.length; i++) {
                        if (strength.strength_id === userStrengths[i].strength_id) {
                            if (userStrengths[i].strength_rank < 6) {
                                return this.styleText;
                            }
                        }
                    }
                    return ''
                }

            },

            sortArray() {

                this.departments.sort(function (a, b) {

                    let departmentA = a.department_name.toUpperCase();
                    let departmentB = b.department_name.toUpperCase();
                    if (departmentA < departmentB) {
                        return -1;
                    }
                    if (departmentA > departmentB) {
                        return 1;
                    }
                    return 0;
                });

                for (let i = 0; i < this.departments.length; i++) {
                    if (this.departments[i].users.length > 0) {

                        this.departments[i].users.sort(function (a, b) {

                            let userNameA = a.user_name.toUpperCase();
                            let userNameB = b.user_name.toUpperCase();
                            if (userNameA < userNameB) {
                                return -1;
                            }
                            if (userNameA > userNameB) {
                                return 1;
                            }
                            return 0;
                        })
                    }

                }

            },

            fetchCategories() {

                axios.get('categories').then(response => {
                    this.categories = response.data;
                    this.loopThrough(this.categories);
                });
            },
            fetchDepartment() {
                axios.get('departments').then(response => {
                    this.departments = response.data;
                    this.sortArray();

                })
            },

            loopThrough(categories) {
                for (let i = 0; i < categories.length; i++) {
                    if (categories[i].strengths.length > 0) {
                        this.strengths = this.strengths.concat(categories[i].strengths);

                    }
                }
            },

            checkStrength(strength, userStrengths) {
                for (let i = 0; i < userStrengths.length; i++) {
                    if (strength.strength_id === userStrengths[i].strength_id) {
                        return userStrengths[i].strength_rank;
                    }
                }
                return '';
            },
        }
    }
</script>

<style scoped>

</style>