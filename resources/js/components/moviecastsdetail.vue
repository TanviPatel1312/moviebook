<template>
    <div>
        <div class="latest-products">
            <div class="container" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading"  >
                            <h2>MovieDetails</h2>
                        </div>
                            <div class="col-md-12-md-4">
                            <div class="product-item">
                                <a href="#"><img src="" alt=""></a>
                                <div class="down-content">
                                    <h2>{{movies.title}}</h2>
                                    <h6>{{movies.runtime}}</h6>
                                    <p>{{movies.overview}}</p>
                                    <h4>{{movies.releaseyear}}</h4>
                                    <h2>castMemeber</h2><br>
                                    <div  v-for="(cast,index) in casts" :key="index">
                                    <h4>{{cast.name}}</h4>
                                    <h4>{{cast.bio}}</h4>
                                    </div>
                                    <br>

                                    <router-link class="btn btn-primary" :to="'/theatresDetail/'+movies.id">MovieBook</router-link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "moviecastsdetail",

    mounted() {
        console.log('Component mounted.')
    },
    data: function () {
        return {
            id: "",
            m_id: "",
            c_id: "",
            movies: [],
            casts: [],

        }
    },
    methods: {
        getMovie: function () {
            axios.get('/api/getmovie/'+ this.$route.params.id)
                .then(response => {
                    this.movies = response.data
                   this.movies = this.movies[0]
                })
                .catch(error => {
                    console.log(error);
                })

        }, getCast: function () {
            axios.get('/api/getcast/'+this.$route.params.id)
                .then(response => {
                    this.casts = response.data
                   // this.casts = this.casts[0]
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getAllMovieIds: function (id) {
            axios.get('/api/movies/'+id)
                .then(response => {
                    this.movies = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },

    },
    created() {

        this.getMovie();
        this.getCast();

    }

}
</script>

<style scoped>

</style>
