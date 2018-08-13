<template>
    <div >
        <div v-show="edit===false">
            <p class="text" @dblclick="changeText"><b>{{ elementName }}:</b>{{ elementdata }}</p>

        </div>
        <input  v-show="edit" v-model="elementdata" @keyup.enter="upload">
        <button v-show="edit" v-on:click="setedit">Cancel</button>
        <button v-show="edit" v-on:click="upload">Save</button>
    </div>
</template>

<script>
    export default {
        name: "EditableInputComponent",
        props: ['endpoint', 'elementName', 'data'],

        data(){
            return{
                elementdata: null,
                edit: false,
                showinput:false,
            }
        },
        mounted() {
          this.elementdata = this.data;
        },
        methods: {
            changeText: function() {
                if (this.edit) {
                    this.edit = false;
                }
                else {
                    this.edit = true;

                }
            },
            setedit: function(){

                console.log(this.edit);
                if (this.edit){
                    this.edit=false;
                }
                else {
                    this.edit=true;
                }

                /*this.edit=false;*/
                console.log(this.edit);
            },

            upload: function(){

                this.edit = false;

                let vm = this;
                axios.post(this.endpoint,{data: this.elementdata}).then(response => {
                    vm.$emit('input-updated', response);
                });
            },
        }

    }
</script>
<style>
    .inputstyle{
        border: 1px solid black;
        border-radius: 12px;
    }
</style>