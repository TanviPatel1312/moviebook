<template>
    <div align="center">
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
                    v-model="item.title"
                >
            </div>
            <div class="form-group">
                <label for="overview"></label>
                <input
                    type="text"
                    id="overview"
                    placeholder="Enter overview"
                    class="form-control"
                    v-model="item.overview"
                >
            </div>
            <div class="form-group">
                <label for="releaseyear"></label>
                <input
                    type="number"
                    id="releaseyear"
                    placeholder="Enter releaseyear"
                    class="form-control"
                    v-model="item.releaseyear"
                >
            </div>
            <div class="form-group">
                <label for="runtime"></label>
                <input
                    type="number"
                    id="runtime"
                    placeholder="Enter runtime"
                    class="form-control"
                    v-model="item.runtime"
                >
            </div>
            <div class="form-group">
                <button class="btn btn-success" @click="createMovie" type="submit">Submit</button>
            </div>

        </div>
    </div>
</template>

<script>
export default{
    name: "Directory",
    data(){
        return{
            lists:[],
            item:{
                title: '',
                overview: '',
                releaseyear: '',
                runtime: ''
            },
            temp_id: null,
            isEditing: false
        }
    },
    mounted() {
        this.fetchAll();
    },
    methods: {
        fetchAll(){
            axios.get('/api/movie')
                .then(res=>this.lists=res.data)

        },
        createMovie(){
            let method = axios.post;
            let url = '/api/movie'

            if(this.isEditing){
                method = axios.put;
                url = `/api/movie/${this.temp_id}`
            }

            try{
                method(url,this.item)
                    .then(res=>{
                        this.fetchAll();
                        this.item={
                            title: '',
                            overview: '',
                            releaseyear: '',
                            runtime: ''
                        };
                        this.temp_id= null;
                        this.isEditing= false;
                    })
            }catch(e){
                console.log(e)
            }

        },
        editTel(movie){
            this.item = {
                title: movie.title,
                overview: movie.overview,
                releaseyear: movie.releaseyear,
                runtime: movie.runtime,
            }
            this.temp_id=movie.id;
            this.isEditing = true

        },
        deleteTel(id){
            try{
                axios.delete(`/api/movie/${id}`)
                    .then(res=> this.fetchAll())

            }catch(e){

            }
        }
    }
}
</script>
