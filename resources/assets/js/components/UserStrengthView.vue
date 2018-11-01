<template>
    <div class="card-body">
        <h1>User Strength</h1>
        <admin-user-strength v-for="(strength,index) in strengthCount"
                             :key="index+1"
                             :strengthIndex="index+1"
                             :propStrengths="strengths"
                             @pushSelected="pushSelected($event)"

        >
        </admin-user-strength>

        <button type="submit" @click="submit()" class="btn btn-success">Save</button>
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
                selectedStrength: [],
                isNew: false,

            }
        },
        watch: {
            selectedStrength(value) {
                /*this.selectedStrength=value;*/
            }
        },
        mounted() {
            axios.get('/strength/list').then(response => {
                this.strengths = response.data;
            });
        },
        methods: {
            pushSelected(obj) {
                this.selectedStrength.push(obj);
            },
            submit(){
              if(this.selectedStrength.length<=12){
                  let data = this.selectedStrength;
                axios.post('/user/'+this.userId+'/update/strength',data)
              }
            },
        }


    }
</script>

<style scoped>

</style>