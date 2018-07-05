<template>
    <div>
        <div v-show="edit===false">
            <p  class="text" @dblclick="changeText"><b>{{ elementName }}:</b>{{ data }}</p>
        </div>
        <input v-show="this.edit" v-model="data" @keyup.enter="edit=false; upload">
    </div>
</template>

<script>
    export default {
        name: "EditableInputComponent",
        props: ['userId', 'elementName', 'data'],
        data(){
            return{
                edit: false
            }
        },
        methods: {
            changeText() {
                if (authUser.id === this.userId || Vue.$isAdmin()) {
                    if (this.edit) {
                        this.edit = false;
                    }
                    else {
                        this.edit = true;
                    }
                }
            },
            upload(){
                let vm = this;
                axios.post('/update',{data: this.data}).then(response => {
                    vm.$emit('file-uploaded', response);
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