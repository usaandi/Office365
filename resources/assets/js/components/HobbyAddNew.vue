<template>
    <div>
        <div v-show="!add">
            <input ref="edit"  >
        </div>
        <button  v-on:click="add=!add" >Edit</button>
    </div>
</template>

<script>
    export default {
        name: "HobbyAddNew",
        data: function () {
            return{
                add:true,
            }
        
        },
        methods: {



            showInput: function () {
                console.log(add.toString());
                if (this.add) {
                    this.add = false;
                }
                else {
                    this.add = true;
                }
            }
        }
    }
</script>

<style scoped>

</style>