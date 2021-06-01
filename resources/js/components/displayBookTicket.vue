<template>
<div>
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
    name: "displayBookTicket",
    data: function () {
        return {
            lists: {
            showtime: "",
            showtimedate: "",
            seats:[],
            username: "",
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
