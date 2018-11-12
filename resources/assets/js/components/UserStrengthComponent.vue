<template>
    <div class="form-group m-form__group row">

        <label :for="selected"
               class="col-sm-3 col-xs-12  col-form-label">Strength{{strengthIndex}}</label>
        <div  class="col-sm-9 col-xs-12">
            <select class="form-control m-input" :disabled="checkDisable" v-model="selected" @change="pushToArray()">
                <option></option>
                <option v-for="strength in sortArray(propStrengths)"
                        :value="strength">{{strength.strength_name}}
                </option>
            </select>
        </div>
    </div>
</template>


<script>
    export default {
        props: ['strengthIndex', 'propStrengths'],
        name: "UserStrengthComponent",
        data() {
            return {
                selectOptions: [],
                selected: {},
                checkDisable: false,
            }

        },
        mounted() {

        },
        methods: {
            sortArray(array) {
                return _.orderBy(array, 'strength_name');
            },
            pushToArray() {
                if (this.selected !== '') {
                    let data = {
                        strength_id: this.selected.strength_id,
                        strength_name: this.selected.strength_name,
                        strength_index: this.strengthIndex
                    };
                    this.$emit('pushSelected', data);
                    this.checkDisable = true;
                }
            }/*,
            selectedObject(){
                this.selected={strength}

            }*/
        }
    }
</script>

<style scoped>

</style>