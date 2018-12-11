<template>
    <div>
        <h3>Table Strength</h3>
        <div class="table-responsive">
            <span class="float-right m--margin-bottom-5"><a :href="'/admin/strength'" class="btn btn-success m-btn m-btn--icon m-btn--pill">
               <span>Add Strength</span></a></span>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Strength name</th>
                        <th>Strength description</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr is="strength-component" v-for="(strength,index) in strengthsCategories"
                        :key="strength.strength_id"
                        :index="index"
                        :prop-strength="strength"
                        :prop-categories="categories"
                        @deleteStrength="deleteStrength($event)"

                    >
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: [],
        name: "StrengthCategoryView",
        data() {
            return {
                strengthsCategories: '',
                categories: null,
            }
        },
        mounted() {
            this.fetchCategoryStrengthData();
        },

        methods: {
            fetchCategoryStrengthData() {
                axios.get('/admin/strength/info').then(response => {
                    this.strengthsCategories = response.data[0];
                    this.categories = response.data[1];
                });
            },
            deleteStrength(index) {
                const data = {
                    strengthId: this.strengthsCategories[index].strength_id,
                };
                let array = this.strengthsCategories;

                axios.delete('admin/strength/delete', {params: data})
                    .then(function (response) {
                        if (response.status === 200) {
                            array.splice(index, 1);
                        }
                    });

            }
        },
    }
</script>

<style scoped>

</style>