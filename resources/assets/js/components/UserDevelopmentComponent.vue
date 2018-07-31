<template>
    <div class="container-fluid">

        <div class="col-md-2">
            <h2>TIMELINE COMES HERE</h2>
        </div>

        <div class="col-md-10 d-inline boxstyle ">

            <h2 class="text-color-cyan inline-block">Goal Title</h2>
            <p class="">consectetur adipiscing elit.
                Morbi consequat lorem vehicula augue sollicitudin,
                vel finibus felis imperdiet. Ut et odio sed risus maximus suscipit.
                Aliquam faucibus velit eget nunc fringilla tincidunt. Donec nisi nisl,
                tristique ac sodales quis, efficitur sed enim. Fusce at orci ante.consectetur adipiscing elit.
                Morbi consequat lorem vehicula augue sollicitudin,
                vel finibus felis imperdiet. Ut et odio sed risus maximus suscipit.
                Aliquam faucibus velit eget nunc fringilla tincidunt. Donec nisi nisl,
                tristique ac sodales quis, efficitur sed enim. Fusce at orci ante.consectetur adipiscing elit.
                Morbi consequat lorem vehicula augue sollicitudin,
                vel finibus felis imperdiet. Ut et odio sed risus maximus suscipit.
                Aliquam faucibus velit eget nunc fringilla tincidunt. Donec nisi nisl,
                tristique ac sodales quis, efficitur sed enim. Fusce at orci ante.Lorem ipsum dolor sit amet,
                consectetur adipiscing elit.
                Morbi consequat lorem vehicula augue sollicitudin,
                vel finibus felis imperdiet. Ut et odio sed risus maximus suscipit.
                Aliquam faucibus velit eget nunc fringilla tincidunt. Donec nisi nisl,
                tristique ac sodales quis, efficitur sed enim. Fusce at orci ante.
            </p>

            <h2 class=" text-color-cyan inline-block margin-right-10">MILESTONES</h2>
            <button class="button text-color-black-14 medium-btn">+ New</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserDevelopmentComponent",
        props: [],

    }
</script>

<style scoped>
    .boxstyle{
        border: 1px solid #e1e1e1;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .text-color-cyan{
        color: #00adee;
    }
    .margin-right-10{
        margin-right:10px;
    }
    .button {

        background-color: white;
        border-radius: 10px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;

    }
    .text-color-black-14{
        font-size:14px;
        color: black;
    }
    .medium-btn{
        width: 90px;
        height:30px;
    }

    .inline-block{
        display: inline-block;
    }
</style>