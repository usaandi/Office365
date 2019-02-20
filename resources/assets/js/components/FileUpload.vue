<template>
    <div>
        <div class="profile__avatar--overlay">
            <div class="profile__avatar--action"><span class="btn m-btn--pill btn-success fileinput-button"><i
                    class="la la-plus"></i> <span> Add image... </span> <input id="imageChoose" type="file"
                                                                               v-on:change="onFileChange"></span>
                <button v-if="image" @click="deleteImage" type="submit" class="btn m-btn--pill btn-info"><i
                        class="la la-upload"></i>
                    <span> Delete image </span></button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Vue from 'vue';

    export default {
        name: "FileUpload",
        props: ['endpoint', 'userId', 'currentImage'],
        data() {
            return {
                image: this.currentImage,
            }
        },
        methods: {
            onFileChange: function (e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage: function (file) {

                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                    this.upload();
                };
                reader.readAsDataURL(file);


            },
            upload: function () {
                let vm = this;

                axios.post(this.endpoint, {image: this.image}).then(response => {
                    vm.$emit('file-uploaded', response);
                });

            },
            deleteImage() {

                let vm = this;
                this.image = '';
                axios.patch('adm/user/image/' + vm.userId).then(response => {
                    vm.$emit('imageDelete', response);

                });

            }

        }
    }
</script>