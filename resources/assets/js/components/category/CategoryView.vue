<template>
    <div>
        <h3>Table Category</h3>
        <span class="float-left"><a :href="'/admin/strength'" class="text-success">
                <i class="fa fa-plus fa-2x"
                   aria-hidden="true"></i></a></span>
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>Category name</th>
                <th>Category description</th>
                <th>Category colour</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr is="category-component" v-for="(category, index) in categories "
                :propCategory="category"
                :key="category.id"
                :index="index"
                @deleteCategory="deleteCategory($event)"
            ></tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: [],
        name: "CategoryView",
        data() {
            return {
                categories: [],
            }
        },
        watch: {},
        mounted() {
            this.fetchCategoryData();

        },
        methods: {
            deleteCategory(index) {
                const data = {
                    categoryId: this.categories[index].id,
                };
                let array = this.categories;

                      axios.delete('admin/category/delete', {params:data})
                          .then(function (response) {
                              if(response.status === 200){
                                  array.splice(index, 1);
                              }
                          });
            },

            fetchCategoryData() {
                axios.get('/admin/category/info').then(response => {
                    this.categories = response.data;
                });
            }
        }
    }


</script>

<style scoped>

</style>