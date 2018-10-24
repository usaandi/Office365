<template>
    <div>
        <h3>Table Strength</h3>
        <div class="table-responsive">
            <span class="float-left m--margin-bottom-5"><a class="text-success">
                <i class="fa fa-plus fa-2x"
                   aria-hidden="true"></i></a></span>
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
                <tr>
                    <th scope="row">1</th>

                    <td>Willpower</td>
                    <td>control exerted to do something or restrain impulses</td>
                    <td>Executing (needs to have select capabilities on edit click)</td>
                    <td>
                        <span><button type="button" class="btn btn-success">Edit</button></span>
                    </td>
                    <td>
                        <span><button type="button" class="btn btn-danger">Remove</button></span>
                    </td>
                </tr>

                </tbody>
            </table>

            <h3>Table Category</h3>
            <span class="float-left"><a class="text-success">
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
                <tr>
                    <th scope="row">1</th>
                    <td>Executing</td>
                    <td>control exerted to do something or restrain impulses</td>
                    <td>Input color box?</td>
                    <td>
                        <span><button type="button" class="btn btn-success">Edit</button></span>
                    </td>
                    <td>
                        <span><button type="button" class="btn btn-danger">Remove</button></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        name: "category",
        data() {
            return {
                strengthCategory: [],
                category: [],
            }
        },
        mounted() {
            this.fetchCategoryStrengthData();
            this.fetchCategoryData();
        },
        methods: {

            fetchCategoryStrengthData() {
                axios.get('/admin/category/strength/info').then(response => {
                    this.strengthCategory = response.data;


                });
            },
            fetchCategoryData() {
                axios.get('/admin/category/info').then(response => {
                    this.category = response.data;
                });
            }
        }


    }
</script>

<style scoped>

</style>