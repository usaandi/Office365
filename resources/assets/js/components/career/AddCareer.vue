<template>
    <div class="col-md-6">
        <b-form-group
              id="fieldsetHorizontal"
              horizontal
              :label-cols="2"
              breakpoint="md"
              label="Development Title"
              label-for="inputDevelopmentTitle">
            <b-form-input id="inputDevelopmentTitle"
                          v-model="title"
                          type="text"
                          placeholder="Title"
            ></b-form-input>
        </b-form-group>
        <b-form-group
                id="fieldsetHorizontal"
                horizontal
                :label-cols="2"
                breakpoint="md"
                label="Development Description"
                label-for="developmentDesc">
            <b-form-textarea
                id="developmentDesc"
                v-model="desc"
                placeholder="Description"
                :rows="3"
                :max-rows="6"
                :no-resize="true"
            ></b-form-textarea>
        </b-form-group>
            <button @click="submit">submit</button>
            <button @click="clear">clear</button>

        <b-alert variant="success"
                 dismissible
                 :show="showDismissibleAlert"
                 @dismissed="showDismissibleAlert=false">
            Success!
        </b-alert>

    </div>
</template>

<script>

    import BootstrapVue from 'bootstrap-vue';
    import axios from 'axios';

    Vue.use(BootstrapVue);
    export default {
        name: "adddevelopment",
        data(){
            return{
                desc:'',
                title:'',
                showDismissibleAlert:false,
                showDismissibleAlert1:false,
            }
        },
        methods:{

            clear: function () {
                this.desc='';
                this.title='';
            },

            submit: function () {
                let data= JSON.stringify({
                    title: this.title,
                    description: this.desc,

                });
                this.desc='';
                this.title='';
                let vm=this;
                axios.post('/career/add',data)
                    .then(response => {
                        if(response.status===200){
                            this.showDismissibleAlert=true;
                        }
                    }).catch(error => {

                });
            }
        }
    }
</script>

<style scoped>
 .border-box{
     border:1px solid black;
 }
</style>