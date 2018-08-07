<template>
    <div>
        <p>Selected: {{ selected }}</p>
        <select2 :options="options" v-model="selected">
            <option disabled value="0">Select one</option>
        </select2>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        props: [],
        name: "HobbyAdd",
        data() {
            return {
                hobbieoptions:[],
                selected: 2,
                options: []
            }
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            fetchData: function () {
                let vm = this;
                axios.get('http://localhost/hobbies')
                .then(response=> {
                    this.hobbieoptions=response.data;
                    for (let i=0; i < this.hobbieoptions.length; i++) {
                        console.log(this.hobbieoptions[i].hobby_name);
                        vm.options.push({id: i, text: this.hobbieoptions[i].hobby_name});
                    }
                })

            }
        },

    }
</script>

<style scoped>

</style>