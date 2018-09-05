<template>
    <div>
        <h3 class="profile__subtitle">Role</h3>
        <div class="profile__text">
            <p>Coordinate with designers and developers to develop various new products and features along with various
                interactive designs within required timeframe.</p>
            <p>Develop new business initiatives in coordination with UE team and design various methodologies and practices
                for innovative interactive technologies and perform quality assurance and browser computability tests.</p>
            <p>Design style sheets for website and assist application programmers in effective implementation and ensure
                all work according to scripting code with help of various technologies.</p>
            <p>Collaborate with designers and application developer to develop various customized websites.</p>
            <p>Prepare all production documents on Photoshop and translate same into HTML templates with help of developers
                and designers and facilitate to introduce new features into same.</p>
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