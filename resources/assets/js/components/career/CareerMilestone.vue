<template>
<div >
    <div class="profile-timeline__milestone">
        <div class="m-form__group form-group">
            <div class="m-checkbox-list">
                <label class="m-checkbox m-checkbox--air m-checkbox--state-success">
                    <input type="checkbox">
                    <div class="profile-timeline__milestones--label">{{milestone.task}}</div>
                    <span></span>
                    <div class="profile-timeline__milestones--name">
                        <div class="m-list-pics m-list-pics--sm">
                            <a href="#"><img src="" title=""></a>
                            {{milestone.assigned_username}}
                        </div>
                    </div>
                    <div class="profile-timeline__milestones--date m--font-danger">
                        {{milestone.reminder}}
                    </div>
                    <div class="profile-timeline__milestones--action">
                        <a href="#" class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill">
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
        props:['milestoneInfo'],
        data(){
            return {

                taskName:'',
                assigned:'',
                reminder:'',
                milestone:[],
            }
        },
        mounted(){

            this.milestone = this.milestoneInfo;
        },
        methods:{

            submit(){

            }

        },
    }
</script>

<style scoped>

</style>