<template>
    <div>
        <label>Strength {{strengthIndex}}</label>
        <select  :disabled="checkDisable" v-model="selected" @change="pushToArray()">
            <option ></option>
            <option v-for="strength in sortArray(propStrengths)"
                    :value="strength">{{strength.strength_name}}</option>
        </select>
    </div>
</template>


<script>
    export default {
        props:['strengthIndex','propStrengths'],
        name: "UserStrengthComponent",
        data(){
            return{
                selectOptions:[],
                selected:{},
                checkDisable:false,
            }

        },
        mounted(){

        },
        methods:{
            sortArray(array){
                return _.orderBy(array,'strength_name');
            },
            pushToArray(){
                if(this.selected !== ''){
                    let data = {
                        strength_id: this.selected.strength_id,
                        strength_name: this.selected.strength_name,
                        strength_index: this.strengthIndex
                    };
                    this.$emit('pushSelected', data);
                    this.checkDisable=true;
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