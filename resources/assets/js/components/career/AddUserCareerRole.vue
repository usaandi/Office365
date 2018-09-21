<template>
<div>
    <div class="m-portlet__body">
        <div class="form-group m-form__group row"><label class="col-3 col-form-label">Role Title</label>
            <div class="col-9"><input type="text" placeholder="Title" class="form-control m-input" v-model="title"></div>
            <label class="col-3 col-form-label">Description</label>
            <div class="col-9"><input type="text" placeholder="Description" class="form-control m-input" v-model="description"></div>
        </div>
    </div>

    <div class="m-portlet__foot m-portlet__foot--fit">
        <div class="m-form__actions">
            <div class="row">
                <div class="col-sm-9 col-xs-12">
                    <div class="profile-timeline__action">
                        <button @click="submit()"  class="btn btn-success m-btn m-btn--pill"><span><span>Save</span></span></button>
                        <button  class="btn btn-danger m-btn m-btn--pill"><span><span>Cancel</span></span></button>
                     </div>
                </div>
             </div>
        </div>
    </div>
</div>
</template>

<script>
    import axios from 'axios';


    export default {
        props:['selectedUserProfileId','authUserId'],
        name: "AddUserCareerRole",
        data(){
            return{

                description:'',
                title:'',
            }
        },
        methods:{
            submit(){

                const data = [{

                    description: this.description,
                    title: this.title,
                    selectedUserProfileId: this.selectedUserProfileId,
                    authUserId: this.authUserId,

                }];
                let vm = this;
                axios.post('/user/'+this.selectedUserProfileId+'/career/role/create',data)
                    .then(response => {

                    }).catch(error => {

                });


            },
        }
    }
</script>

<style scoped>

</style>