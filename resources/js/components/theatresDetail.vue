<template>
<div>

    <div class="latest-products">
        <div class="container" >
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading"  >
                        <h2>Theatres</h2>
                    </div>

                    <div class="col-md-12-md-4"  v-for="item in theaters"
                         :key="item.id">
                        <div class="product-item">
                            <div class="down-content" >
                                <h3>{{item.title}}</h3><br>
                                <h5>TheatreName:{{item.name}}</h5>
                                <h5>startTime:{{item.starttime}}</h5>
                                <h5>endTime:{{ item.endtime }}</h5>
                                <h5>seatsAvailable:{{ item.seatsAvailable}} </h5>
<!--                                <h6>city:{{item.cityname}}</h6>-->
                               <h5> <span>totalseat:{{ item.totalseat}} </span></h5>

                                <div  v-for="(city,index) in cities" :key="index">
                                    <h6>city:{{city.cityname}}</h6>
                                </div>
                                <div  v-for="(movie,index) in movies" :key="index">
                                    <h6>{{movie.title}}</h6>
                                </div>
                                <br>
                                <router-link class="btn btn-primary" :to="'/bookmovie/'+item.id">MovieBook</router-link>
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
    name: "theatresDetail",
    mounted() {
        console.log('Component mounted.')
    },
    data: function () {
        return {
            lists:[],
            m_id: "",
            t_id: "",
            city_id:"",
            movies: [],
            theaters: [],
            cities: [],

        }
    },
    methods: {

        getMovie: function () {
            axios.get(`/api/getMovie/`+ this.$route.params.id)
                .then(response => {
                    this.movies = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },
      getCity: function () {
            axios.get('/api/getCity/'+ this.$route.params.id)
                .then(response => {
                    this.cities = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getTheatre: function () {
            axios.get('/api/getTheatre/'+ this.$route.params.id)
                .then(response => {
                    this.theaters = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },getAllMoviePost:function () {
            axios.get('/api/movieposts/' + id)
                .then(response => {
                    this.theatres = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        }

    },
    created() {

        this.getMovie();
        this.getCity();
        this.getTheatre();
        this.getAllMoviePost();

    }
}
</script>

<style scoped>

</style>
