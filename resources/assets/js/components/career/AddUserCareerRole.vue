<template>
<div>
    <div class="m-portlet__body">
        <div class="form-group m-form__group row">
            <label class="col-3 col-form-label">Role</label>
            <div class="col-9">
                <input type="hidden" placeholder="Title" class="form-control m-input">
            </div>
            <label class="col-3 col-form-label">Select Role</label>
            <div class="col-9">
                <select class="form-control m-input" id="Assign" v-model="careerRoleId" @change="create(careerRoleId)">
                    <option></option>
                    <option v-for="career in careerRoleTitle" :value="career.id">
                        {{career.title}}
                    </option>
                </select>
            </div>
        </div>
    </div>

    <div class="m-portlet__foot m-portlet__foot--fit">
        <div class="m-form__actions">
            <div class="row">
                <div class="col-sm-9 col-xs-12">
                    <div class="profile-timeline__action">
                        <button @click="save"  class="btn btn-success m-btn m-btn--pill"><span><span>Save</span></span></button>
                        <button @click="remove" class="btn btn-danger m-btn m-btn--pill"><span><span>Cancel</span></span></button>
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
                careerRoleTitle:'',
                careerRoleId:'',
            }
        },
        mounted(){
            this.fetch();
        },
        methods:{

            create(){
                this.$emit('createRole', this.careerRoleId);
            },
            remove(){
                this.$emit('remove');

            },
            save(){
                this.$emit('save', true);
            },


            fetch(){
                axios.get('/test').then(response => {
                    this.careerRoleTitle = response.data;
                })
            }



        }
    }
</script>

<style scoped>

</style>