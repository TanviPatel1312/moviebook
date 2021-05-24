<template>
<div>

    <div class="latest-products">
        <div class="container" >
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading"  >
                        <h2>Theatres</h2>
                    </div>
                    <div class="col-md-12-md-4" v-for="item in lists"
                         :key="item.id">
                        <div class="product-item">
                            <a href="#"><img src="" alt=""></a>
                            <div class="down-content">
                                <h2>TheatreName:{{item.name}}</h2>
                                <h5>startTime:{{item.starttime}}</h5>
                                <h5>endTime:{{ item.endtime }}</h5>
                                <h5>seatsAvailable:{{ item.seatsAvailable}} </h5>
                               <h5> <span>totalseat:{{ item.totalseat}} </span></h5>
                                <router-link class="nav-link" to="/bookmovie">MovieBook</router-link>
                                <h2  v-for="item in movie"
                                     :key="item.id">

                                    <h3>startTime:{{item.title}}</h3>

                            </h2>
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
    data(){
        return {
            lists: [],
            name: "",
            starttime: "",
            endtime: "",
            price: "",
            seatsAvailable: "",
            totalseat: "",
            movie:[],
            title:"",
        }

        },
    mounted() {
        this.fetchAll();
    },
    methods: {
        fetchAll() {
            axios.get('all_theatre')
                .then(res => this.lists = res.data)
        },
        getMovie: function () {
            axios.get(`/api/getMovie`)
                .then(response => {
                    this.theaters = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },

    }
}
</script>

<style scoped>

</style>
