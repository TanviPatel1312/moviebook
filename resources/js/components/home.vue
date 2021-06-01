<template>
    <div>
        <header class="">
                <nav class="navbar navbar-expand-lg">
                    <div class="container">
                        <a class="navbar-brand" href="#"><h2>Movie <em>Book</em></h2></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarResponsive">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <router-link class="nav-link" to="/">Home</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link class="nav-link" to="/displayBookTicket">displayBookTicket</router-link>
                                </li>
<!--                                <li class="nav-item">-->
<!--                                    <router-link class="nav-link" to="/login">Login</router-link>-->
<!--                                </li>-->
<!--                                <li class="nav-item">-->
<!--                                    <router-link class="nav-link" to="/register">Register</router-link>-->
<!--                                </li>-->

                            </ul>
                        </div>
                    </div>
                </nav>

        </header>

            <!-- Page Content -->
            <!-- Banner Starts Here -->

            <!-- Banner Ends Here -->


            <div class="latest-products">
                <div class="container" >
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-heading"  >
                                <h2>Latest movie</h2>
                        </div>
                            <div class="input-group">
                                <input type="search"  v-model="str" @keyup="searchMovie" class="form-control rounded" placeholder="Search" aria-label="Search"
                                       aria-describedby="search-addon" />
                                <button type="button" class="btn btn-outline-primary">search</button>
                            </div><br><br>
                            <div class="row">
                            <div class="col-md-6" v-for="item in movies"
                                 :key="item.id">
                                <div class="product-item">
                                    <a href="#"><img src="" alt=""></a>
                                    <div class="down-content">
                                        <h2>{{item.title}}</h2><br>

                                        <router-link class="btn btn-primary" :to="'/moviecastsdetail/'+item.id" >ReadMore</router-link>

                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="inner-content">
                                <p>Copyright &copy; 2020 latest Movie.

                                    - Design: <a rel="tanvi patel">Tanvi Patel</a></p>
                            </div>
                        </div>
                    </div>

                </div>
            </footer>
        </div>
</template>

<script>
export default {
    name: "home",
    mounted() {
        console.log('Component mounted.')
    },
    data: function () {
        return {
            str: "",

            movies: {
                title: "",
            }

        }
    },
    methods: {
        fetchAll(){
            axios.get('all_castmovie')
                .then(res=>this.lists=res.data)

        },

        getMovie: function () {
            axios.get('/api/getmovie')
                .then(response => {
                    this.movies = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getCast: function () {
            axios.get('/api/getcast')
                .then(response => {
                    this.casts = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getAllMovieCast: function () {
            axios.get('/api/moviecast/'+id)
                .then(response => {
                    this.moviecast = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getPostMovies: function () {
            axios.get('/api/getMovieHome')
                .then(response => {
                    this.movies = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },


        searchMovie: function () {
            if (this.str === "") {
                this.getPostMovies();
            } else {
                axios.get('/api/search/' + this.str)
                    .then(response => {
                        this.movies= response.data
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    },

    created() {
        this.fetchAll();
        this.getMovie();
        this.getCast();
        this.getAllMovieCast();
        this.getPostMovies();

    }
}
</script>

<style scoped>

</style>
