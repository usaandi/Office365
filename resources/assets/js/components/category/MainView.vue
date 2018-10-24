<template>
    <div>

        <strength-category-view :propStrengthsCategories="strengthsCategories">
        </strength-category-view>


        <category-view>
        </category-view>

    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        name: "MainView",
        data() {
            return {
                strengthsCategories: [],

            }
        },
        mounted() {
            this.fetchCategoryStrengthData();

        },
        methods: {

            fetchCategoryStrengthData() {
                axios.get('/admin/category/strength/info').then(response => {
                    this.strengthsCategories = response.data;


                });
            },

        }


    }
</script>

<style scoped>

</style>