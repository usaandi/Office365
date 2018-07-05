<template>
    <div>
        <div v-show="edit===false">
            <p class="text" @dblclick="changeText"><b>{{ elementName }}:</b>{{ elementdata }}</p>
        </div>
        <input v-show="edit" v-model="elementdata" @keyup.enter="upload">
    </div>
</template>

<script>
    export default {
        name: "EditableInputComponent",
        props: ['endpoint', 'elementName', 'data'],
        data(){
            return{
                elementdata: null,
                edit: false
            }
        },
        mounted() {
          this.elementdata = this.data;
        },
        methods: {
            changeText() {
                if (this.edit) {
                    this.edit = false;
                }
                else {
                    this.edit = true;
                }
            },
            upload(){

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