<template>
    <div>

        <div class="profile__strenght" :title="strength.strength_description">
            <div class="profile__strenght--info">
                <i class="la la-lightbulb-o"></i>{{strength.strength_name}}
            </div>
            <div class="progress m-progress--custom">
                <div class="progress-bar m--bg-in fo" role="progressbar"
                     :style="{width: calculateWidth(), backgroundColor: strength.category_colour}"
                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        name: "UserStrenght",
        props: ['strength'],
        data() {
            return {
                userStrength: this.strength,
            }
        },
        methods: {

            calculateWidth() {
                return 100 - (Math.round(90 * this.userStrength.strength_rank / 12)) + '%';
            }
        },


    }
</script>

<style scoped>

</style>