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
                    </li>                </ul>

            </div>
        </nav>
        <div class="col-md-6">
            <div class="form-group">
                <div style="padding: 15px">
                    <h3 class="text-center">Add the showtime details!! </h3>
                </div>
                <label for="showtime"></label>
                <input
                    type="time"
                    id="showtime"
                    placeholder="Enter showtime"
                    class="form-control"
                    v-model="showtime"
                >
            </div>

            <button class="btn btn-success btn-block" @click="save">
                {{isEditing ? 'update':'save'}}
            </button>
            <div class="col-md-12 mt-3" v-if="lists.length > 0">
                <h2 class="text-center">showtime detail</h2>

                <ul class="list-group">
                    <li
                        class="list-group-item"
                        v-for="item in lists"
                        :key="item.id"
                    >
                        {{item.showtime}}

                        <span class="float-right">
                <button class="btn btn-warning btn-sm mr-2"
                        data-toggle="modal"   data-target="#exampleModal" @click="editshow(item.id)">Edit</button>
                <button class="btn btn-danger btn-sm mr-2" @click="deleteshow(item.id)">Delete</button>
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
                                    <label for="editshowtime">ShowTime</label>
                                    <input type="text" v-model="editshowtime"  class="form-control" id="editshowtime"  placeholder="Enter showtime">
                                </div>

                                <button type="submit"  @click.prevent="updateshow" data-dismiss="modal" class="btn btn-primary">Submit</button>
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
    name: "showtime",
    data(){
        return{
            lists:[],
            showtime: "",
            editshowtime: '',
        }
    },
    mounted() {
        this.fetchAll();
    },
    methods: {
        fetchAll(){
            axios.get(`allshow`)
                .then(res=>this.lists=res.data)
        },
        save(){
            axios.post(`save`,{
                showtime :this.showtime,
            })
                .then(res=>{

                    this.showtime= "",
                        this.fetchAll();

                })
        },
        editshow(id){
            axios.get(`edit/`+id)
                .then(response=>{
                    this.id = response.data.id;
                    this.editshowtime = response.data.showtime;


                })
        },
        updateshow(){
            axios.put(`update`,{
                id : this.id,
                showtime :this.editshowtime,

            })
                .then(response => {
                    this.fetchAll();
                } );
        },
        deleteshow(id){
            try{
                axios.delete(`delete/` +id)
                    .then(res=> this.fetchAll())

            }catch(e){

            }
        }
    }
}
</script>

<style scoped>

</style>
