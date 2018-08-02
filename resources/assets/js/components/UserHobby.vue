<template>
    <div>
        <div class="user-list-wrapper">
            <div v-for="hobby in userhobbies">
               <p>#{{ hobby.hobby_name }}</p>
            </div>
            <hobby-add></hobby-add>
        </div>

    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "UserHobby",
        props: ['userid'],
        data() {
            return {
                id: '',
                userhobbies: [],
                hobbyname: '',
            }
        },
        mounted() {
            this.id = this.userid;
            this.fetchData();
        },
        methods:{
            fetchData: function () {
              axios.get('http://localhost/user/' + this.id + '/hobby')
                  .then(response => {
                      this.userhobbies = response.data;
                  });
            },
        }
    }
</script>

<style scoped>

</style>