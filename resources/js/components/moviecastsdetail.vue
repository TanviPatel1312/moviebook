<template>
    <div>
        <div class="latest-products">
            <div class="container" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading"  >
                            <h2>Cast</h2>
                        </div>
                        <div class="col-md-12-md-4" v-for="item in lists"
                             :key="item.id">
                            <div class="product-item">
                                <a href="#"><img src="" alt=""></a>
                                <div class="down-content">
                                    <h2>{{item.name}}</h2>
                                    <h3>{{item.bio}}</h3>
                                    <router-link class="nav-link" to="/bookmovie">MovieBook</router-link>

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
    data(){
        return {
            lists: [],
            name: "",
            bio: "",

        }

    },
    mounted() {
        this.fetchAll();
    },
    methods: {
        fetchAll() {
            axios.get('all_cast')
                .then(res => this.lists = res.data)
        },
    }
}
</script>
<style scoped>

</style>
