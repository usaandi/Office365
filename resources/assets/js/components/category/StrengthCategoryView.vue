<template>
    <div>
        <h3>Table Strength</h3>
        <div class="table-responsive">
            <span class="float-left m--margin-bottom-5"><a  :href="'/admin/strength'" class="text-success">
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
                <tr v-for="strCate in propStrengthsCategories">
                    <th scope="row">{{strCate.strength_id}}</th>

                    <td>{{strCate.strength_name}}</td>
                    <td>{{strCate.strength_description}}</td>
                    <td :value="strCate.category_id">{{strCate.category_name}}(needs to have select capabilities on edit click)</td>
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
    export default {
        props:['propStrengthsCategories'],
        name: "StrengthCategoryView",
        data(){
            return{

            }
        },

        methods:{

        },
    }
</script>

<style scoped>

</style>