<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Casts Movie</div>

                    <div class="card-body">

                        <div class="form-group">
                            <label>Select Caste:</label>
                            <select class='form-control' v-model='c_id'>
                                <option value='0' >Select Caste</option>
                                <option v-for="(cast,index) in casts" :key="index" :value="cast.id">{{ cast.name }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Select Movie:</label>
                            <select class='form-control' v-model='m_id'>
                                <option value='0' >Select Movie</option>
                                <option v-for='data in movies' :value='data.id'>{{ data.title }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "moviecast",
    mounted() {
        console.log('Component mounted.')
    },
    data(){
        return {
           m_id:"",
            c_id:"",
            movies: [],
            casts: [],
        }
    },
    methods: {
        getmovie: function () {
            axios.get('/api/getmovie')
                .then(response => {
                    this.movies = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        }, getcast: function () {
            axios.get('/api/getcast')
                .then(response => {
                    this.casts = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },
        created: function(){
            this.getmovie();
            this.getcast();

        },

    }
}
</script>

<style scoped>

</style>
