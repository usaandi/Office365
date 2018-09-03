<template>
    <div class="container-fluid">
        <div class='cool-border'>
            <div class="row padding-20-top">
                <div class="col-1">
                    <h3 class="color-cyan text-center padding-left-title">BIG BOSS</h3>
                </div>
                <div class="col-11 ">
                    <p class="text-left padding-left-text">
                        Hello world Hello world Hello world
                        Hello world Hello world Hello world Hello world
                        Hello world Hello world Hello world Hello world
                        Hello world Hello world Hello world Hello world
                        Hello world Hello world Hello world Hello world
                    </p>
                </div>
            </div>
            <div class="row">
                <user-milestone></user-milestone>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "CareerModal",
        data(){
            return{
                isHidden:false,

            }
        },

    }
</script>

<style scoped>
.cool-border{
    border: 1px solid #e1e1e1;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>