<template>
    <div align="center">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1>ADMIN</h1>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <router-link  class="nav-link" to="/dashboard">Dashboard <span class="sr-only">(current)</span></router-link>
                    </li>
                    <li class="nav-item ">
                        <router-link class="nav-link" to="/movies">Movie</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link  class="nav-link" to="/casts">Casts </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/theatres">Theatres</router-link>
                    </li>

                </ul>

            </div>
        </nav>
        <div class="col-md-6">
            <div class="form-group">
                <div style="padding: 15px">
                    <h3 class="text-center">Add the Cast details!! </h3>
                </div>
                <label for="name"></label>
                <input
                    type="text"
                    id="name"
                    placeholder="Enter name"
                    class="form-control"
                    v-model="name"
                >
            </div>
            <div class="form-group">
                <label for="bio"></label>
                <input
                    type="text"
                    id="bio"
                    placeholder="Enter bio"
                    class="form-control"
                    v-model="bio"
                >
            </div>

            <button class="btn btn-success btn-block" @click="save">
                {{isEditing ? 'update':'save'}}
            </button>
            <div class="col-md-12 mt-3" v-if="lists.length > 0">
                <h2 class="text-center">Cast detail</h2>

                <ul class="list-group">
                    <li
                        class="list-group-item"
                        v-for="item in lists"
                        :key="item.id"
                    >
                        {{item.name}} - {{item.bio}}

                        <span class="float-right">
                <button class="btn btn-warning btn-sm mr-2"
                        data-toggle="modal"     data-target="#exampleModal" @click="editcast(item.id)">Edit</button>
                <button class="btn btn-danger btn-sm mr-2" @click="deletecast(item.id)">Delete</button>
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
                                    <label for="editcast">Title</label>
                                    <input type="text" v-model="editcast"  class="form-control" id="editcast"  placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="editbio">Overview</label>
                                    <input type="text"  v-model="editbio"  class="form-control" id="editbio" placeholder="Enter bio">
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
export default{
    name: 'casts',
    data(){
        return{
            lists:[],

            name: "",
            bio: "",

            editname: '',
            editbio :'',



        }
    },
    mounted() {
        this.fetchAll();
    },
    methods: {
        fetchAll(){
            axios.get(`all_cast`)
                .then(res=>this.lists=res.data)

        },
        save(){
            axios.post(`save_cast`,{
                name :this.name,
                bio: this.bio,

            })
                .then(res=>{

                    this.name= "",
                        this.bio= "",

                    this.fetchAll();

                })


        },
        editcaste(id){

            axios.get(`edit_cast/`+id)
                .then(response=>{
                    this.id = response.data.id;
                    this.editname = response.data.name;
                    this.editbio = response.data.bio;

                })
        },
        update(){
            axios.put(`update_cast`,{
                id : this.id,
                name :this.editname,
                bio : this.editbio,
            })
                .then(response => {
                    this.fetchAll();
                } );


        },
        deletcast(id){
            try{
                axios.delete(`delete_cast/` +id)
                    .then(res=> this.fetchAll())

            }catch(e){

            }
        }
    }
}
</script>
