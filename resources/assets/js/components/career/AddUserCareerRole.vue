<template>
<div>
    <div class="m-portlet__body m--margin-top-10">
        <div class="form-group m-form__group row">
            <label class="col-3 col-form-label">Select Role</label>
            <div class="col-9">
                <select class="form-control m-input"  id="Assign" v-model="careerRoleId" @change="create(careerRoleId)">
                    <option Disabled selected >Select Role</option>
                    <option v-for="career in careerRoleTitle" :value="career.id">
                        {{career.title}}
                    </option>
                </select>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import axios from 'axios';


    export default {
        props:['selectedUserProfileId','authUserId','canEdit','hasMilestoneError'],
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
                if(this.canEdit===true && this.careerRoleId !== ''){

                    this.$emit('createRole', this.careerRoleId);
                    this.careerRoleId='';
                }
            },

            fetch(){
                axios.get('/career/roles').then(response => {
                    this.careerRoleTitle = response.data;
                })
            },
        }
    }
</script>

<style scoped>

</style>