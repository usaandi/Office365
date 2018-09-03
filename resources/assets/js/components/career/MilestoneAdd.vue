<template>
    <div>
    <div class="col-2">
        <h3 class="color-cyan padding-left-title">MILESTONES</h3>
    </div>
    <div class="col-10">
            <button class="btn btn-success" v-show="!hidden" @click="hidden=true">+ New</button>
            <div class="box" v-show="hidden" >
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
                    <button class="btn btn-danger" @click="hidden=false">Cancel</button>
                    <button class="btn btn-success" @click="submit()">Save</button>
                </div>
            </div>
            <ul class="list-unstyled m--margin-bottom-5  m--padding-top-5">
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
</template>

<script>
    export default {
        name: "MilestoneAdd",
        data(){
            return {
                hidden:false,
            }
        }
    }
</script>

<style scoped>
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
</style>