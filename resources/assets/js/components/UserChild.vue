<template>
    <div>
        <div class="">
            <div v-for="child in userchildren">
                <p>{{ child.name }} | {{child.year_born}}</p>
            </div>
            + Add new
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
                userchildren: [],
                childname: '',
            }
        },
        mounted() {
            this.id = this.userid;
            this.fetchData();
        },
        methods:{
            fetchData: function () {
                axios.get('http://localhost/user/' + this.id + '/child')
                    .then(response => {
                        this.userchildren = response.data;
                    });
            },
        }
    }
</script>

<style scoped>

</style>