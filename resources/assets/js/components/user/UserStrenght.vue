<template>
    <div>

        <div class="profile__strenght" @click="showInput()">
            <div class="profile__strenght--info">
                <i class="la la-lightbulb-o" ></i> {{this.userStrength.strength_name}}
            </div>
            <div class="progress m-progress--custom" >
                <div class="progress-bar m--bg-info"  role="progressbar"
                     :style="{width:this.progressValue+'%'}"
                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>

            </div>
            <input v-show="admin && show" type="range" v-model="progressValue"
                   @change="showValue(progressValue,userStrength.id)">

        </div>

    </div>
</template>

<script>
    export default {
        name: "UserStrenght",
        props: ['userid', 'strength'],
        data() {
            return {

                progressValue: '',
                currentUser: '',
                show: false,
                admin: false,
                test: null,
                userStrength: {},


            }
        },
        mounted() {
            this.currentUser = this.userid;
            this.checkAdmin();
            this.userStrength = this.strength;
            this.progressValue = this.strength.value;


        },
        methods: {
            showInput() {
                    this.show === false ? this.show = true : this.show = false;

            },
            checkAdmin() {
                Vue.$isAdmin() ? this.admin = true : this.admin = false;
            },
            showValue(value, id) {
            }


        },

    }
</script>

<style scoped>

</style>