<template>
    <div  class="profile-timeline__form" >
        <form class="m-form">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <label for="Task" class="col-3 col-form-label">Task</label>
                    <div class="col-9" >
                        <input  id="Task" class="form-control m-input" placeholder="Task">
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="Assign" class="col-3 col-form-label">Assign</label>
                    <div class="col-9">
                        <select class="form-control m-input" id="Assign" >
                            <option>me</option>
                            <option>inimem</option>
                            <option>kered</option>
                            <option>toodo</option>
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label for="Reminder" class="col-3 col-form-label">Set reminder</label>
                    <div class="col-9">
                        <input  type="date" id="Reminder" class="form-control m-input" placeholder="Task">
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                        </div>
                        <div class="col-sm-9 col-xs-12">
                            <div class="profile-timeline__action"><button  type="button" class="btn m-btn--pill btn-outline-success m-btn m-btn--custom">Cancel</button>
                                <button type="button" class="btn m-btn--pill btn-success m-btn m-btn--custom" @click="submit()">Save</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "CareerMilestoneForm",
        data(){
            return{
                show:false,
            }
        }
    }
</script>

<style scoped>

</style>