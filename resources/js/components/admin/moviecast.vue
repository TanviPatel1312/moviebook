<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1>ADMIN</h1>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <router-link  class="nav-link" to="/dashboard">Dashboard <span class="sr-only">(current)</span></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/movies">Movie</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link  class="nav-link" to="/casts">Casts </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/theatres">Theatres</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/moviecast">MovieCast</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/movieTheatre">moviePost</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/city">Cities</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/showtime">movieshowtime</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/displaymoviebook">displaymoviebook</router-link>
                    </li>
                </ul>

            </div>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Casts Movie</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Caste:</label>
                            <select class='form-control' id="getcast" v-model='c_id' >
                                <option v-for="cast in casts"  :value="cast.id">{{cast.name}}</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label>Select Movie:</label>
                            <select class='form-control' id="getmovie" v-model='m_id' >
                                <option v-for="movie in movies" :value="movie.id">{{movie.title}}</option>
                            </select>
                        </div>
                            <button class="btn btn-primary" @click="save">Add</button>
                        <div>


                            <h2 class="text-center">CastMovie detail</h2>

                            <ul class="list-group">
                                <li
                                    class="list-group-item"
                                    v-for="item in lists"
                                    :key="item.id"
                                >
                                    {{item.name}} - {{item.title}}

                                    <span class="float-right">
                <button class="btn btn-warning btn-sm mr-2"
                        data-toggle="modal"     data-target="#exampleModal"   @click="editCasteMovie(item.id)">Edit</button>
                <button class="btn btn-danger btn-sm mr-2" @click="deleteCastMovie(item.id)">Delete</button>
                </span>

                                </li>
                            </ul>
                        </div>
                        </div>
                    </div>
                </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label>Select Caste:</label>
                                    <select class='form-control' v-model='editc_id' @change="getCast">
                                        <option v-for="cast in casts"  :value="c_id.id">{{cast.name}}</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Select Movie:</label>
                                    <select class='form-control' v-model='editm_id' @change="getMovie">
                                        <option v-for="movie in movies" :value="m_id.id">{{movie.title}}</option>
                                    </select>
                                </div>

                                <button type="submit"  @click.prevent="update" data-dismiss="modal" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
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
    data: function () {
        return {
                lists:[],
                m_id: "",
                c_id: "",
            editm_id: '',
            editc_id :'',
                movies: [],
                casts: [],

        }
    },
    methods: {
        fetchAll(){
            axios.get('all_castmovie')
                .then(res=>this.lists=res.data)

        },
        save() {
            axios.post(`save_CastMovie`, {
                c_id: this.c_id,
                m_id: this.m_id,

            })
                .then(res => {
                    this.c_id = "",
                        this.m_id = "",
                        this.fetchAll();

                })
        },
        editCasteMovie(id){

            axios.get(`edit_CastMovie/`+id)
                .then(response=>{
                    this.id = response.data.id;
                    this.editc_id = response.data.c_id;
                    this.editm_id = response.data.m_id;

                })
        },
        update(){
            axios.put(`update_CastMovie`,{
                id : this.id,
                c_id :this.editc_id,
                m_id : this.editm_id,
            })
                .then(response => {
                    this.fetchAll();
                } );


        },
        deleteCastMovie(id){
            try{
                axios.delete(`delete_CastMovie/`+id)
                    .then(res=> {
                            this.fetchAll()
                        }
                    )

            }catch(e){

            }
        },
        getMovie: function () {
            axios.get('/api/getmovie')
                .then(response => {
                    this.movies = response.data
                })
                .catch(error => {
                    console.log(error);
                })
            // console.log('getmovie');
        }, getCast: function () {
            axios.get('/api/getcast')
                .then(response => {
                    this.casts = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        },

    },
    created() {
        this.fetchAll();
            this.getMovie();
            this.getCast();
    }

}
</script>

<style scoped>

</style>
