<template>
    <tr>
        <th scope="row">{{strength.strength_id}}</th>
        <td>
            <span v-show="!show">{{strength.strength_name}}</span>
            <input @change="hasChanged(strength.strength_name)"
                   v-show="show" v-model="strengthName" type="text">
        </td>
        <td>
            <span v-show="!show"> {{strength.strength_description}}</span>
            <textarea @change="hasChanged(strength.strength_description)"
                      v-show="show" v-model="strengthDescription" ></textarea>
        </td>
        <td :value="strength.category_id">
            <span v-show="!show">{{strength.category_name}}</span>
            <select @change="hasChanged(selected)" v-show="show" v-model="selected">
                <option></option>
                <option v-for="category in categories" :value="category">
                    {{category.category_name}}
                </option>
            </select>
        </td>
        <td>
            <span><button @click="edit()" type="button" class="btn btn-success">{{buttonText}}</button></span>
        </td>
        <td>
            <span><button @click="remove(index)" type="button" class="btn btn-danger">Remove</button></span>
        </td>
    </tr>
</template>

<script>
    export default {
        props: {
            'propStrength': {type: Object},
            'index': {type: Number},
            'propCategories': {required: true}
        },
        name: "StrengthCategoryComponent",
        data() {
            return {
                strength: {},
                categories: [],
                show: false,
                selected: '',
                strengthName: '',
                strengthDescription: '',
                buttonText: 'Edit',
                changedFlag: false,

            }
        },
        watch: {
            strength(value) {
            }
        },
        mounted() {
            this.strength = this.propStrength;
            this.categories = this.propCategories;
        },
        methods: {
            remove(index) {
                this.$emit('deleteStrength', index);
            },
            edit() {

                if (this.show === false) {
                    this.show = true;
                    this.strengthName = this.strength.strength_name;
                    this.strengthDescription = this.strength.strength_description;
                    this.selected = {
                        category_name: this.strength.category_name,
                        category_id: this.strength.category_id,
                    };
                    this.buttonText = 'Cancel';

                } else {


                    if (this.changedFlag === true) {
                        this.update();
                    }

                    this.show = false;
                    this.buttonText = 'Edit';
                }
            },
            hasChanged(){
                if (this.strengthName !== '' && this.selected !== '' && this.strengthDescription !== '') {
                    this.buttonText = 'Save';
                    this.changedFlag = true;
                }
            },

            update() {
                this.changedFlag = false;
                const data = {
                    strength_id: this.strength.strength_id,
                    strength_name: this.strengthName,
                    strength_description: this.strengthDescription,
                    category_id: this.selected.category_id,
                    category_name: this.selected.category_name,
                };
              axios.post('admin/strength/update', data)
                    .then(response => {
                        if (response.status === 200) {
                            this.strength.strength_name = response.data.strength_name;
                            this.strength.strength_description = response.data.strength_description;
                            this.strength.category_name = response.data.category_name;
                            this.strength.category_id = response.data.category_id;
                        }
                    }).catch(error => {

                });

            }
        }
    }
</script>

<style scoped>

</style>