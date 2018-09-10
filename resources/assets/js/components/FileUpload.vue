<template>
    <div>
        <input id="imageChoose" type="file" v-on:change="onFileChange" class="form-control">
        <button class="btn btn-success btn-block" @click="upload">SAVE</button>
    </div>
</template>

<script>
    export default {
        name: "FileUpload",
        props: ['endpoint'],
        data(){
            return {
                image: ''
            }
        },
        methods: {
            onFileChange: function(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage: function(file) {

                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            upload: function(){
                let vm = this;
                axios.post(this.endpoint,{image: this.image}).then(response => {
                    vm.$emit('file-uploaded', response);
                });
            }
        }
    }
</script>