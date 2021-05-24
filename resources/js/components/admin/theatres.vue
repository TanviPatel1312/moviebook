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
                    <li class="nav-item">
                        <router-link class="nav-link" to="/movies">Movie</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link  class="nav-link" to="/casts">Casts </router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/theatres">Theatres</router-link>
                    </li>

                </ul>

            </div>
        </nav>
        <div class="col-md-6">
            <div class="form-group">
                <div style="padding: 15px">
                    <h3 class="text-center">Add the theatres details!! </h3>
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
                <label for="starttime"></label>
                <input
                    type="time"
                    id="starttime"
                    placeholder="Enter starttime"
                    class="form-control"
                    v-model="starttime"
                >
            </div>
        <div class="form-group">
            <label for="endtime"></label>
            <input
                type="time"
                id="endtime"
                placeholder="Enter endtime"
                class="form-control"
                v-model="endtime"
            >
    </div>
    <div class="form-group">
        <label for="price"></label>
        <input
            type="number"
            id="price"
            placeholder="Enter price"
            class="form-control"
            v-model="price"
        >
    </div>
    <div class="form-group">
        <label for="seatsAvailable"></label>
        <input
            type="number"
            id="seatsAvailable"
            placeholder="Enter seatsAvailable"
            class="form-control"
            v-model="seatsAvailable"
        >
    </div>
    <div class="form-group">
        <label for="totalseat"></label>
        <input
            type="number"
            id="totalseat"
            placeholder="Enter totalseat"
            class="form-control"
            v-model="totalseat"
        >
    </div>

            <button class="btn btn-success btn-block" @click="save">
                {{isEditing ? 'update':'save'}}
            </button>
            <div class="col-md-12 mt-3" v-if="lists.length > 0">
                <h2 class="text-center">Theatres Detail</h2>

                <ul class="list-group">
                    <li
                        class="list-group-item"
                        v-for="item in lists"
                        :key="item.id"
                    >
                        {{item.name}} - {{item.starttime}} - {{item.endtime}} - {{item.price}} - {{item.seatsAvailable}} - {{item.totalseat}}

                        <span class="float-right">
                <button class="btn btn-warning btn-sm mr-2" data-toggle="modal"  data-target="#exampleModal" @click="editTheatres(item.id)">Edit</button>
                <button class="btn btn-danger btn-sm mr-2" @click="deleteTheatres(item.id)">Delete</button>
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
                                    <label for="editname">Name</label>
                                    <input type="text" v-model="editname"  class="form-control" id="editname"  placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="editstarttime">StartTime</label>
                                    <input type="time"  v-model="editstarttime"  class="form-control" id="editstarttime" placeholder="Enter startTime">
                                </div>
                                <div class="form-group">
                                    <label for="editendtime">Release year</label>
                                    <input type="time" v-model="editendtime" class="form-control" id="editendtime"  placeholder="Enter EndTime">
                                </div>
                                <div class="form-group">
                                    <label for="editprice">Cast Members</label>
                                    <input type="number" v-model="editprice" class="form-control" id="editprice"  placeholder="Enter price">
                                </div>
                                <div class="form-group">
                                    <label for="editseatsAvailable">seatsAvailable</label>
                                    <input type="number" v-model="editseatsAvailable" class="form-control" id="editseatsAvailable"  placeholder="Enter seatsAvailable">
                                </div>
                                <div class="form-group">
                                    <label for="edittotalseat">totalseat</label>
                                    <input type="number" v-model="edittotalseat" class="form-control" id="edittotalseat"  placeholder="Enter totalseat">
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
    name: "theatres",
    data(){
        return {
            lists: [],
            name: "",
            starttime: "",
            endtime: "",
            price: "",
            seatsAvailable: "",
            totalseat: "",

            editname: '',
            editstarttime: '',
            editendtime: '',
            editprice: '',
            editseatsAvailable: '',
            edittotalseat: '',
        }
    },
    mounted() {
        this.fetchAll();
    },
    methods:{
        fetchAll(){
            axios.get('all_theatre')
                .then(res=>this.lists=res.data)
        },
        save(){
            axios.post('save_theatre',{
                name :this.name,
                starttime: this.starttime,
                endtime:this.endtime,
                price : this.price,
                seatsAvailable:this.seatsAvailable,
                totalseat : this.totalseat,
            })
                .then(res=>{

                    this.name= "",
                        this.starttime= "",
                        this.endtime= "",
                        this.price= ""
                    this.seatsAvailable= "",
                        this.totalseat= ""
                    this.fetchAll();

                })
        },
        editTheatres(id){

            axios.get('edit_theatre/'+id)
                .then(response=>{
                    this.id = response.data.id;
                    this.editname = response.data.name;
                    this.editstarttime = response.data.starttime;
                    this.editendtime = response.data.endtime;
                    this.editprice = response.data.price;
                    this.editseatsAvailable = response.data.seatsAvailable;
                    this.edittotalseat = response.data.totalseat;
                })
        },
        update(){
            axios.put('update_theatre',{
                id : this.id,
                name :this.editname,
                starttime : this.editstarttime,
                endtime: this.editendtime,
                price : this.editprice,
                seatsAvailable: this.editseatsAvailable,
                totalseat : this.edittotalseat
            })
                .then(response => {
                    this.fetchAll();
                } );


        },
        deleteTheatres(id){
            try{
                axios.delete(`delete_theatre/` +id)
                    .then(res=> this.fetchAll())

            }catch(e){

            }
        }
    }
}
</script>

<style scoped>

</style>

