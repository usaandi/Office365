<template>
    <div class="m-portlet__body">
        <div v-show="success" class="alert alert-success alert-dismissible text-center">
            <a class="close" @click="success=!success"></a>
            <strong>SUCCESS!</strong>
        </div>
        <h1>User Strength</h1>
        <admin-user-strength v-for="(strength,index) in strengthCount"
                             :key="index+1"
                             :strengthIndex="index+1"
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
                strengthCount: 10,
                categories: null,
                selectedStrength: [],
                isNew: false,
                showMessage: false,
                message: null,
                success: false,

            }
        },
        watch: {
            selectedStrength(value) {

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

                /*for (let i = 0; i < this.categories.length; i++) {
                    for (let j = 0; j < this.categories[i].strengths.length; j++) {
                        if (obj.strength_id === this.categories[i].strengths[j].strength_id){
                            this.categories[i].strengths.splice(j,1);
                        }

                    }

                }*/

            },
            submit() {
                let data = this.selectedStrength;
                axios.patch('/user/' + this.userId + '/update/strength', data).then(response => {
                    if (response.status === 200) {
                        this.showMessage = true;
                        this.message = response.data;
                        this.success = true;
                    }
                })

            },
        }


    }
</script>

<style scoped>

</style>