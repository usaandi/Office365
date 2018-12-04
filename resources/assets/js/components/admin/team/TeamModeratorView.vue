<template>
    <div>
        <p>hello world . {{id}}</p>
    </div>
</template>

<script>
    export default {
        props:{
          id:{
            required:true

          },

        },
        name: "TeamModeratorView"
    }
</script>

<style scoped>

</style>