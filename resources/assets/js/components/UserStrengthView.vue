<template>
    <div class="m-portlet__body">

        <h1>User Strength</h1>
        <admin-user-strength v-for="(strength,index) in strengthCount"
                             :key="index+1"
                             :strengthIndex="index+1"
                             :propStrengths="strengths"
                             :propCategories="categories"
                             @pushSelected="pushSelected($event)"

        >
        </admin-user-strength>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-sm-3 col-xs-12"></div>
                    <div class="col-sm-9 col-xs-12">
                        <div class="profile-timeline__action">
                            <button type="submit" @click="submit" class="btn btn-success m-btn m-btn--pill">
                                <span><span>Submit</span></span></button>
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
        props: ['userId'],
        name: "UserStrengthView",
        data() {
            return {
                strengthCount: 12,
                strengths: [],
                categories:null,
                selectedStrength: [],
                isNew: false,
                showMessage:false,
                message:null,

            }
        },
        watch: {
            selectedStrength(value) {
                /*this.selectedStrength=value;*/
            }
        },
        mounted() {
            axios.get('/strength/list').then(response => {

                this.categories = response.data;
            });
        },
        methods: {
            pushSelected(obj) {
                this.selectedStrength.push(obj);
            },
            submit(){
              if(this.selectedStrength.length<=12){
                  let data = this.selectedStrength;
                  let vm =this;
                axios.post('/user/'+this.userId+'/update/strength',data).then(response=>{
                    if(response.status===200){
                        vm.showMessage=true;
                        vm.message=response.data;
                    }
                })
              }
            },
        }


    }
</script>

<style scoped>

</style>