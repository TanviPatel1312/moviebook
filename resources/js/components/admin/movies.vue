<template>
    <div align="center">
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
        <div class="col-md-6">
            <div class="form-group">
                <div style="padding: 15px">
                    <h3 class="text-center">Add the Movie details!! </h3>
                </div>
                <label for="title"></label>
                <input
                    type="text"
                    id="title"
                    placeholder="Enter title"
                    class="form-control"
                    v-model="title"
                >
            </div>
            <div class="form-group">
                <label for="overview"></label>
                <input
                    type="text"
                    id="overview"
                    placeholder="Enter overview"
                    class="form-control"
                    v-model="overview"
                >
            </div>
            <div class="form-group">
                <label for="releaseyear"></label>
                <input
                    type="number"
                    id="releaseyear"
                    placeholder="Enter releaseyear"
                    class="form-control"
                    v-model="releaseyear"
                >
            </div>
            <div class="form-group">
                <label for="runtime"></label>
                <input
                    type="time"
                    id="runtime"
                    placeholder="Enter runtime"
                    class="form-control"
                    v-model="runtime"
                >
            </div>
            <button class="btn btn-success btn-block" @click="save">
                {{isEditing ? 'update':'save'}}
            </button>
            <div class="col-md-12 mt-3" v-if="lists">
                <h2 class="text-center">Movie detail</h2>

                <ul class="list-group">
                    <li
                        class="list-group-item"
                        v-for="item in lists"
                        :key="item.id"
                    >
                        {{item.title}} - {{item.overview}} - {{item.releaseyear}} - {{item.runtime}}

                        <span class="float-right">
                <button class="btn btn-warning btn-sm mr-2"
                        data-toggle="modal"     data-target="#exampleModal" @click="editmovie(item.id)">Edit</button>
                <button class="btn btn-danger btn-sm mr-2" @click="deletemovie(item.id)">Delete</button>
                </span>

                    </li>
                </ul>

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
                                    <label for="edittitle">Title</label>
                                    <input type="text" v-model="edittitle"  class="form-control" id="edittitle"  placeholder="Enter title">
                                </div>
                                <div class="form-group">
                                    <label for="editoverview">Overview</label>
                                    <input type="text"  v-model="editoverview"  class="form-control" id="editoverview" placeholder="Enter overview">
                                </div>
                                <div class="form-group">
                                    <label for="edityear">Release year</label>
                                    <input type="number" v-model="edityear" class="form-control" id="edityear"  placeholder="Enter year">
                                </div>
                                <div class="form-group">
                                    <label for="editruntime">runtime</label>
                                    <input type="text" v-model="editruntime" class="form-control" id="editruntime"  placeholder="Enter cast">
                                </div>
                                <button type="submit"  @click.prevent="updatemovie" data-dismiss="modal" class="btn btn-primary">Submit</button>
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
export default{
    name: 'movies',
    data(){
        return{
            lists:[],

                title: "",
                overview: "",
                releaseyear: "",
                runtime: "",
            edittitle: '',
            editoverview :'',
            edityear:'',
            editruntime:'',


        }
    },

    methods: {
        fetchAll(){
            axios.get(`all_movie`)
                .then(res=>this.lists=res.data)

        },
        save(){
            axios.post('save_movie',{
                title :this.title,
                overview: this.overview,
                releaseyear:this.releaseyear,
                runtime : this.runtime,
            })
            .then(res=>{
               this.title= "",
                    this.overview= "",
                    this.releaseyear= "",
                    this.runtime= ""
                this.fetchAll();
            })
        },
        editmovie(id){

            axios.get('edit_movie/'+id)
                .then(response=>{
                    this.id = response.data.id;
                    this.edittitle = response.data.title;
                    this.editoverview = response.data.overview;
                    this.edityear = response.data.releaseyear;
                    this.editruntime = response.data.runtime;
                })
        },
        updatemovie(){
            axios.put('update_movie',{
            id : this.id,
            title :this.edittitle,
            overview : this.editoverview,
            releaseyear: this.edityear,
            runtime : this.editruntime
        })
            .then(response => {
                this.fetchAll();
            } );


        },
        deletemovie(id){
            try{
                axios.delete(`delete_movie/` +id)
                    .then(res=> this.fetchAll())

            }catch(e){

            }
        }

},
    created() {
        this.fetchAll();
        this.getMovie();
        this.getCast();
    },
}
</script>
