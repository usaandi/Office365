<template>
    <div class="container-fluid">
        <div class='cool-border'>
            <div class="row padding-20-top">
                <div class="col-1">
                    <h3 class="color-cyan text-center padding-left-title">BIG BOSS</h3>
                </div>
                <div class="col-11 ">
                    <p class="text-left padding-left-text">Hello world Hello world Hello world
                        Hello world Hello world Hello world Hello world
                        Hello world Hello world Hello world Hello world
                        Hello world Hello world Hello world Hello world
                        Hello world Hello world Hello world Hello world
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h3 class="color-cyan padding-left-title">MILESTONES</h3>
                </div>

                <div class="col-10">
                    <button class="btn btn-success" v-if="!isHidden" @click="isHidden=true">+ New</button>
                    <div class="box" v-show="isHidden">
                        <div class="form-group">
                            <label for="task" class="">Task</label>
                            <input type="text" class="form-control input-border" id="task">
                        </div>
                    <div class="form-group">
                        <label for="assign">Assign</label>
                        <select class="form-control input-border" id="assign">
                            <option>1</option>
                        </select>
                    </div>
                        <div class="form-group">
                            <label for="date">Set reminder</label>
                            <input class="form-control input-border" type="date" id="date">
                        </div>
                        <div >
                            <button class="btn btn-danger" @click="isHidden=false">Cancel</button>
                            <button class="btn btn-success" @click="submit()">Save</button>
                        </div>
                    </div>
                    <ul class="list-unstyled m--margin-bottom-5  m--padding-top-5">
                        <li>
                            <label class="">
                                <b> <input class="checkbox d-inline-block" type="checkbox"  name="completed"/>CSS Masterclass Course</b>
                            </label>
                            <p>
                               <img class="image-radius-50" width="22px" height="22px" src="https://i.ytimg.com/vi/MvpQbVl8c4o/maxresdefault.jpg">
                                  Martin Lillepeenar
                                <time datetime="2013-04-01">April 1st, 2013</time>
                            </p>
                        </li>
                        <li>
                            <label class="d-inline-block">
                                <b> <input class="checkbox d-inline-block" type="checkbox"  name="completed"/>CSS Masterclass Course</b>
                            </label>
                            <p>
                                <img class="image-radius-50" width="22px" height="22px" src="https://i.ytimg.com/vi/MvpQbVl8c4o/maxresdefault.jpg">
                                Martin Lillepeenar
                                <time datetime="2013-04-01">April 1st, 2013</time>
                            </p>
                        </li>
                        <li>
                            <label class="d-inline-block">
                                <b> <input class="checkbox d-inline-block" type="checkbox"  name="completed"/>CSS Masterclass Course</b>
                            </label>
                            <p>
                                <img class="image-radius-50" width="22px" height="22px" src="https://i.ytimg.com/vi/MvpQbVl8c4o/maxresdefault.jpg">
                                Martin Lillepeenar
                                <time datetime="2013-04-01">April 1st, 2013</time>
                            </p>
                        </li>
                        <li>
                            <label class="d-inline-block">
                                <b> <input class="checkbox d-inline-block" type="checkbox"  name="completed"/>CSS Masterclass Course</b>
                            </label>
                            <p>
                                <img class="image-radius-50" width="22px" height="22px" src="https://i.ytimg.com/vi/MvpQbVl8c4o/maxresdefault.jpg">
                                Martin Lillepeenar
                                <time datetime="2013-04-01">April 1st, 2013</time>
                            </p>
                        </li>
                    </ul>
                </div>

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

    .image-radius-50{
        border-radius: 50%;
    }

    .input-border{
        border: 1px solid black;
    }

    .box{
        background-color: #fff7ee;
        max-width: 300px;
        border: 2px solid black;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 25px;
        margin: 25px;
    }


    @media screen and (min-width: 320px) {
        .padding-left-title{
            padding-left: 2rem;
        }
        .padding-left-text{
            padding-left: 2rem;
        }
    }
    @media screen and (min-width: 440px) {
        .padding-left-title{
            padding-left: 2rem;
        }
        .padding-left-text{
            padding-left: 6rem;
        }
    }
    @media screen and (min-width: 768px) {
        .padding-left-text{
            padding-left: 5rem;


        }
    }
    @media screen and (min-width: 1024px) {
        .padding-left {

        }
    }


    .padding-20-top{
        padding-top: 20px;
    }

    .color-cyan{
        color: #199ED8;
    }
    .cool-border{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

</style>