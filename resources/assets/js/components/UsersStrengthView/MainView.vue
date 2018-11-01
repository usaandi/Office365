<template>
    <div class="">
        <table class="table table-bordered text-center table-responsive ">
            <thead>
            <tr>
                <th></th>
                <th v-for="catestre in categoryStrength" :colspan="9"  scope="colgroup" :id="catestre.category_id">
                    <span>{{catestre.category_name}}</span>
                </th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td scope="col"><span>Strength 1</span></td>
                <td scope="col"><span>strength 2</span></td>
                <td scope="col"><span>strength 3</span></td>
                <td scope="col"><span>strength 4</span></td>
                <td scope="col"><span>strength 5</span></td>
                <td scope="col"><span>strength 6</span></td>
                <td scope="col"><span>Self-accurance</span></td>
                <td scope="col"><span>Individualization</span></td>
                <td scope="col"><span>strength 9</span></td>

                <td scope="col"><span>Strength 1</span></td>
                <td scope="col"><span>strength 2</span></td>
                <td scope="col"><span>strength 3</span></td>
                <td scope="col"><span>strength 4</span></td>
                <td scope="col"><span>strength 5</span></td>
                <td scope="col"><span>strength 6</span></td>
                <td scope="col"><span>strength 7</span></td>
                <td scope="col"><span>strength 8</span></td>
                <td scope="col"><span>strength 9</span></td>

                <td scope="col"><span>Strength 1</span></td>
                <td scope="col"><span>strength 2</span></td>
                <td scope="col"><span>strength 3</span></td>
                <td scope="col"><span>strength 4</span></td>
                <td scope="col"><span>strength 5</span></td>
                <td scope="col"><span>strength 6</span></td>
                <td scope="col"><span>strength 7</span></td>
                <td scope="col"><span>strength 8</span></td>
                <td scope="col"><span>strength 9</span></td>

                <td scope="col"><span>Strength 1</span></td>
                <td scope="col"><span>strength 2</span></td>
                <td scope="col"><span>strength 3</span></td>
                <td scope="col"><span>strength 4</span></td>
                <td scope="col"><span>strength 5</span></td>
                <td scope="col"><span>strength 6</span></td>
                <td scope="col"><span>strength 7</span></td>
                <td scope="col"><span>strength 8</span></td>
                <td scope="col"><span>strength 9</span></td>
            </tr>
            <tr>
                <th scope="colgroup">Fenomen</th>
            </tr>
            <tr>
                <td><span>User1</span></td>
                <td><span>1</span></td>
                <td></td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
            <tr>
                <td>User2</td>
            </tr>
            <tr>
                <td>User3</td>
            </tr>
            <tr>
                <td>User4</td>
            </tr>
            <tr>
                <th scope="colgroup">Fenomen</th>
            </tr>
            <tr>
                <td><span>User1</span></td>
                <td><span>1</span></td>
                <td><span></span></td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
            <tr>
                <td>User2</td>
            </tr>
            <tr>
                <td>User3</td>
            </tr>
            <tr>
                <td>User4</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "department",
        data(){
            return{
                categoryStrength:'',
            }
        },
        mounted(){
          this.fetch();
        },
        methods:{
            fetch(){
                axios.get('test1').then(response => {
                   this.categoryStrength=response.data;
                });
            },
            countSpan(){

                   // return this.categoryStrength.length

            },
        }
    }
</script>

<style scoped>
    .rotate {

        transform: rotate(90deg);
        padding-top: 15px;
        padding-bottom: 15px;
    }


</style>