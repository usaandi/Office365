<template>
    <div class="row">
        <div class="col-md-12">
            <input id="imageChoose" type="file" v-on:change="onFileChange" class="form-control">
            <button class="btn btn-success btn-block" @click="upload">SAVE</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FileUpload",
        data(){
            return {
                image: ''
            }
        },
        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {

                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            upload(){
                let vm = this;
                axios.post('/upload',{image: this.image}).then(response => {
                    vm.$emit('file-uploaded', response);
                });
            }
        }
    }
</script>