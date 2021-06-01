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
                    <h3 class="text-center">Add the City details!! </h3>
                </div>
                <label for="cityname"></label>
                <input
                    type="text"
                    id="cityname"
                    placeholder="Enter cityname"
                    class="form-control"
                    v-model="cityname"
                >
            </div>

            <button class="btn btn-success btn-block" @click="save">
                {{isEditing ? 'update':'save'}}
            </button>
            <div class="col-md-12 mt-3" v-if="lists.length > 0">
                <h2 class="text-center">City detail</h2>

                <ul class="list-group">
                    <li
                        class="list-group-item"
                        v-for="item in lists"
                        :key="item.id"
                    >
                        {{item.cityname}}

                        <span class="float-right">
                <button class="btn btn-warning btn-sm mr-2"
                        data-toggle="modal"   data-target="#exampleModal" @click="editcity(item.id)">Edit</button>
                <button class="btn btn-danger btn-sm mr-2" @click="deletecity(item.id)">Delete</button>
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
                                    <label for="editcityname">CityName</label>
                                    <input type="text" v-model="editcityname"  class="form-control" id="editcityname"  placeholder="Enter cityname">
                                </div>

                                <button type="submit"  @click.prevent="updateCity" data-dismiss="modal" class="btn btn-primary">Submit</button>
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
    name: "city",
    data(){
        return{
            lists:[],
            cityname: "",
            editcityname: '',
        }
    },
    mounted() {
        this.fetchAll();
    },
    methods: {
        fetchAll(){
            axios.get(`all_city`)
                .then(res=>this.lists=res.data)

        },
        save(){
            axios.post(`save_city`,{
                cityname :this.cityname,
            })
                .then(res=>{

                    this.cityname= "",
                        this.fetchAll();

                })
        },
        editcity(id){
            axios.get(`edit_city/`+id)
                .then(response=>{
                    this.id = response.data.id;
                    this.editcityname = response.data.cityname;

                })
        },
        updateCity(){
            axios.put(`update_city`,{
                id : this.id,
                cityname :this.editcityname,

            })
                .then(response => {
                    this.fetchAll();
                } );
        },
        deletecity(id){
            try{
                axios.delete(`delete_city/` +id)
                    .then(res=> this.fetchAll())

            }catch(e){

            }
        }
    }
}
</script>

<style scoped>

</style>
