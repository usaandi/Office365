<template>
    <tr>
        <td scope="row">{{category.id}}</td>
        <td>
            <span v-show="!show">{{category.category_name}}</span>
            <input class="form-control m-input" @change="hasChanged(category.category_name)" type="text" v-model="categoryName" v-show="show">
        </td>
        <td class="text-left">
            <span v-show="!show">{{category.category_description}}</span>
            <textarea class="form-control m-input" rows="10" @change="hasChanged(category.category_description)" v-model="categoryDescription"
                      v-show="show">
            </textarea>
        </td>
        <td :style="{backgroundColor: category.category_colour}">
            <span v-show="!show">{{category.category_colour}}</span>
            <input @change="hasChanged(category.category_colour)" type="color" v-model="categoryColour" v-show="show" class="form-control m-input">
        </td>
        <td>
            <span><button type="button" class="btn btn-success" @click="edit()">{{editText}}</button></span>
        </td>
        <td>
            <span><button type="button" class="btn btn-danger"
                          @click="remove(index)">Remove</button></span>
        </td>
    </tr>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['propCategory', 'index'],
        name: "CategoryComponent",
        data() {
            return {
                category: {},
                show: false,
                editText: 'Edit',
                categoryName: '',
                categoryColour: '',
                categoryDescription: '',
                changedFlag: false,
            }
        },
        mounted() {
            this.category = this.propCategory;
        },
        methods: {

            remove(objectIndex) {
                this.$emit('deleteCategory', objectIndex);
            },

            edit() {

                if (this.show === false) {
                    this.show = true;

                    this.categoryName = this.category.category_name;
                    this.categoryColour = this.category.category_colour;
                    this.categoryDescription = this.category.category_description;

                    this.editText = 'Cancel';
                }
                else {

                    if (this.changedFlag === true) {
                        this.update();
                    }
                    this.show = false;
                    this.editText = 'Edit';


                }
            },
            update() {
                this.changedFlag = false;


                const data = {
                    id: this.category.id,
                    category_name: this.categoryName,
                    category_description: this.categoryDescription,
                    category_colour: this.categoryColour,
                };

                axios.post('admin/category/update', data)
                    .then(response => {
                        if (response.status === 200) {

                            this.category.category_name = response.data.category_name;
                            this.category.category_colour = response.data.category_colour;
                            this.category.category_description = response.data.category_description;
                        }
                    }).catch(error => {

                });

            },
            hasChanged() {
                if (this.categoryName !== '' && this.categoryColour !== '' && this.categoryDescription !== '') {
                    this.changedFlag = true;
                    this.editText = 'Save';
                }

            }

        }
    }
</script>

<style scoped>

</style>