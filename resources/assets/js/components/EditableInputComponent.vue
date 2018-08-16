<template>
    <div>
        <p class="text"><b>{{ elementName }}:</b></p>
        <input v-model="elementdata" @keyup.enter="upload">
        <button @click="cancel">Cancel</button>
        <button @click="upload">Save</button>
    </div>
</template>

<script>
    export default {
        name: "EditableInputComponent",
        props: ['endpoint', 'elementName', 'data'],

        data(){
            return{
                elementdata: null,
                edit: true,
                showinput:false,
            }
        },
        mounted() {
          this.elementdata = this.data;
        },
        methods: {
            cancel: function(){
                this.$emit('canceled');
            },

            upload: function(){

                let vm = this;
                axios.post(this.endpoint,{data: this.elementdata}).then(response => {
                    vm.$emit('input-updated', vm.elementdata);
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