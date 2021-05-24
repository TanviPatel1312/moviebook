<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Casts Movie</div>

                    <div class="card-body">

                        <div class="form-group">
                            <label>Select theatre:</label>
                            <select class='form-control' v-model='t_id'>
                                <option value='0' >Select theatre</option>
                                <option v-for="(theatre,index) in theatres" :key="index" :value="theatre.id">{{ theatre.name }}</option>
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
    name: "theatresMoviedetail",
    mounted() {
        console.log('Component mounted.')
    },
    data(){
        return {
            m_id:"",
            t_id:"",
            movies: [],
            theaters: [],
        }
    },
    methods: {
        getMovie: function () {
            axios.get('/api/getMovie')
                .then(response => {
                    this.movies = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        }, getTheatre: function () {
            axios.get('/api/getTheatre')
                .then(response => {
                    this.casts = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },
        created: function(){
            this.getMovie();
            this.getTheatre();

        },

    }
}
</script>

<style scoped>

</style>
