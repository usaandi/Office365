<template>

    <div v-if="" class="alert alert-dismissible text-left" :class="[alertTypeN]" style=""><a
            @click="!error" class="close"></a> <strong>{{error.errorMessage}}</strong>
    </div>
</template>

<script>
    export default {
        props: {
            alertType:{
                required:true,
                description:'alert type (danger, success, info)'
            },
            error: {
                required: true,
            },
        },
        name: "AlertView",
        data() {
            return {
                alertTypeN: 'alert-' + this.alertType,
                show: true,
            }
        }
    }
</script>

<style scoped>

</style>