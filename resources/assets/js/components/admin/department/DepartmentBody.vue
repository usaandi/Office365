<template>
    <tr>
        <td><span>{{department.id}}</span></td>
        <td><span>{{department.department_name}}</span></td>
        <td><span>{{department.department_info}}</span></td>

        <td><span>{{department.department_abbr}}</span></td>
        <td><span class="btn btn-success" @click="edit"> Edit Department</span></td>
        <td>
            <span><button  type="button" class="btn btn-danger"
            >Delete Department</button></span>
        </td>
    </tr>
</template>

<script>
    export default {
        props:['department','index'],
        name: "DepartmentBody",
        data(){
            return{
                selectedDepartment:this.department,
            }
        },
        methods:{
            edit(){
                this.$emit('update',this.selectedDepartment);

            }
        }
    }
</script>

<style scoped>

</style>