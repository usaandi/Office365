<template>
    <div>
        <div v-for="(user, index) in currentUserInfo">
            <div>
                <p v-show="!edit">{{user.user_info}}</p>
                <div >
                    <textarea v-show="edit"  class="border-box" v-model="userInfo"></textarea>
                    <button v-show="edit" @click="upload()">SAVE</button>
                    <button v-show="edit" @click="edit=!edit">CANCEL</button>
                </div>
            </div>
        </div>
        <div class="fc-button-group">
            <button @click="edit=!edit" >Edit</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserRole",
        props:['userid'],

        data(){
            return{

                currentUserId:'',
                currentUserInfo:[],
                userInfo:'',

                edit:false,
            }
        },
        mounted(){
            this.currentUserId=this.userid;
            this.fetchData();




        },
        methods:{

            fetchData: function () {
                axios.get('/user/' + this.currentUserId + '/info')
                    .then(response => {

                        this.currentUserInfo = response.data;
                    });
            },

            upload: function () {

                let data= JSON.stringify({
                    userInfo: this.userInfo
                });
                let vm = this;
                console.log(this.currentUserId);
                axios.post('/user/' + this.currentUserId + '/update/info',data)
                    .then(response => {
                            console.log(response.data())



                    }).catch(error => {

                });

            },

        },
    }
</script>

<style scoped>

    .border-box{
      box-sizing: border-box;
        width:100%;
        height: 300px;
    }
</style>