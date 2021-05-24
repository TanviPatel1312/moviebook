<template>
<div>
    <center>
    <div class="col-md-6">
        <div class="form-group">
            <div style="padding: 15px">
                <h3 class="text-center">Movie Booking details!! </h3>
            </div>
            <label for="Name"></label>
            <input
                type="text"
                id="Name"
                placeholder="Enter name"
                class="form-control"
                v-model="Name"
            >
        </div>
        <div class="form-group">
            <label for="showtime"></label>
            <input
                type="time"
                id="showtime"
                placeholder="Enter showtime"
                class="form-control"
                v-model="showtime"
            >
        </div>
        <div class="form-group">
            <label for="seats"></label>
            <input
                type="number"
                id="seats"
                placeholder="Enter seats"
                class="form-control"
                v-model="seats"
            >
        </div>
        <div class="form-group">
            <label for="city"></label>
            <input
                type="text"
                id="city"
                placeholder="Enter city"
                class="form-control"
                v-model="city"
            >
        </div>

        <button class="btn btn-success btn-block" @click="save">
            Save
        </button>
</div>
    </center>
</div>
</template>

<script>
export default {
    name: "bookmovie",
    data() {
        return {
            lists: [],

            Name: "",
            showtime: "",
            seats: "",
            city: "",
        }
    },
    mounted() {
        this.fetchAll();
    },
    methods: {
        fetchAll() {
            axios.get(`all_book`)
                .then(res => this.lists = res.data)

        },
        save() {
            axios.post('save_book', {
                Name: this.Name,
                showtime: this.showtime,
                seats: this.seats,
                city: this.city,
            })
                .then(res => {

                    this.Name = "",
                        this.showtime = "",
                        this.seats = "",
                        this.city = ""
                    this.fetchAll();

                })


        },
    }
}

</script>

<style scoped>

</style>
