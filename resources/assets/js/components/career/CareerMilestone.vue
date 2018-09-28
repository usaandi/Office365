<template>
<div >
    <div class="profile-timeline__milestone">
        <div class="m-form__group form-group">
            <div class="m-checkbox-list">
                <label :value="milestone.id" class="m-checkbox m-checkbox--air m-checkbox--state-success">
                    <input type="checkbox">
                    <div
                        class="profile-timeline__milestones--label"
                        v-show="!show"

                    >{{milestone.task}}</div>
                    <span></span>
                    <div class="profile-timeline__milestones--name">

                        <input v-model.trim="milestone.task" v-show="show"
                                type="text" class="">

                        <input type="date" v-show="show" v-model="milestone.reminder">

                        <select v-model="selected" v-show="show" >
                            <option></option>
                            <option
                                    v-for="user in usersList"
                                    :value="user"

                            >
                                {{user.name}}</option>
                        </select>
                        <span v-show="show" @click="remove(milestone.id)">X</span>

                        <div class="m-list-pics m-list-pics--sm">
                            <a href="#"><img src="" title=""></a>

                            {{milestone.assigned_username}}
                        </div>
                    </div>
                    <div class="profile-timeline__milestones--date m--font-danger">
                        {{milestone.reminder}}
                    </div>
                    <div class="profile-timeline__milestones--action">
                        <a  @click="focusField()"  class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill">
                            <i class="la la-pencil-square"></i>
                        </a>
                    </div>
                </label>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        name: "CareerMilestone",
        props:['milestoneInfo','usersList'],
        data(){
            return {

                selected:'',
                taskName:'',
                assigned:'',
                reminder:'',
                milestone:[],
                editField:'',
                show:false,
                assignerId:'',
                id:'',
            }
        },
        mounted(){

            this.milestone = this.milestoneInfo;
        },

        watch: {

        },
        methods: {

            change(value){
            },

            remove(index, ){
                this.$emit('removeMilestone',index);
                /*this.milestone[index].pop();*/

            },
            submit() {

            },

            focusField() {

                this.show === false ? this.show=true : this.show=false;

                this.milestone.assigned_id = this.selected.id;
                this.milestone.assigned_username = this.selected.name;

            },

        }
    }
</script>

<style scoped>

</style>