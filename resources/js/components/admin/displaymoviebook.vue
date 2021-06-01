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
    <table class="table">
        <thead class="bg-info">
        <tr>
            <th scope="col">#</th>
            <th scope="col">UserName</th>
            <th scope="col">ShowTime</th>
            <th scope="col">ShowTimeDate</th>
            <th scope="col">SeatNo</th>
            <th scope="col">created_at</th>
        </tr>
        </thead>
        <tbody>
        <tr  v-for="item in lists"
             :key="item.id">
            <td>{{ item.id }}</td>
            <td>{{ item.username }}</td>
            <td>{{ item.showtime }}</td>
            <td>{{item.showtimedate}}</td>
            <td>{{item.seats}}</td>
            <td>{{item.created_at}}</td>
        </tr>

        </tbody>
    </table>
</div>
</template>

<script>
export default {
    name: "displaymoviebook",
    data: function () {
        return {
            lists: {
                showtime: "",
                showtimedate: "",
                seats:"",
                username: "",
                created_at:"",
            }
        }
    },
    methods: {
        fetchAll() {
            axios.get(`all_book`)
                .then(res => this.lists = res.data)
        },
    },
    created() {
        this.fetchAll();
    }
}
</script>

<style scoped>

</style>
