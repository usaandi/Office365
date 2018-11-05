<template>
    <div class="">
        <table class="table table-bordered text-center table-responsive ">
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
                    <td v-for="strength in strengths"><span>{{checkStrength(strength, user.strengths)}}</span></td>
                </tr>
            </tbody>
        </table>
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
            }
        },
        mounted() {
            this.fetchCategories();
            this.fetchDepartment();
        },
        methods: {
            fetchCategories() {
                axios.get('categories').then(response => {
                    this.categories = response.data;
                    this.loopThrough(this.categories);
                });
            },
            fetchDepartment() {
                axios.get('departments').then(response => {
                    this.departments = response.data;

                })
            },

            loopThrough(categories) {
                for (let i = 0; i < categories.length; i++) {
                    this.strengths = this.strengths.concat(categories[i].strengths);
                }
            },

            checkStrength(strength, userStrengths) {
                for(let i = 0; i < userStrengths.length; i++ ){
                    if(strength.strength_id === userStrengths[i].strength_id){
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