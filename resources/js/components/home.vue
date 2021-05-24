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
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Page Content -->
            <!-- Banner Starts Here -->
            <div class="banner header-text">
                <div class="owl-banner owl-carousel">
                    <div class="banner-item-01">
                        <div class="text-content">

                        </div>
                    </div>

                </div>
            </div>
            <!-- Banner Ends Here -->

            <div class="latest-products">
                <div class="container" >
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-heading"  >
                                <h2>Latest movie</h2>
                                <a href="/">view all Movies <i class="fa fa-angle-right"></i></a>


                        </div>
                            <div class="row-md-4" v-for="item in lists"
                                 :key="item.id">
                                <div class="product-item">
                                    <a href="#"><img src="" alt=""></a>
                                    <div class="down-content">
                                      <h2>{{item.title}}</h2>
                                        <p>{{item.overview}}</p>
                                        <h5>{{ item.releaseyear }}</h5>
                                        <h6>{{ item.runtime}} </h6>
                                        <div class="row-md-4" v-for="item in cast"
                                             :key="item.id">
                                            <h2>{{item.name}}</h2>
                                            <p>{{item.bio}}</p>
                                        </div>
                                        <router-link class="nav-link" to="/theatresDetail">MovieBook</router-link>
                                     <!-- <span><router-link class="nav-link" to="/moviecastsdetail">MovieCast</router-link></span>-->
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

                                    - Design: <a rel="tanvi patel">Movie APP</a></p>
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
    data() {
        return {

                lists: [],
                cast:[],
                title: "",
                overview: "",
                releaseyear: "",
                runtime: "",
                name:"",
                bio:"",


            }
    },
    mounted() {
        this.fetchAll();
    },
    methods: {
        fetchAll() {
            axios.get(`all_movie`)
                .then(res => this.lists = res.data)
        },

    },
    getcast: function (id) {
        axios.get(`/api/getcast/` + id)
            .then(response => {
                this.casts = response.data
            })
            .catch(error => {
                console.log(error);
            })
    },
    created() {
        this.getcast();
    }
}
</script>

<style scoped>

</style>
