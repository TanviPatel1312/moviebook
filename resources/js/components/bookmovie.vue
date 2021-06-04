<template>
<div>

        <div class="form-group container w-50 my-2">
            <div style="padding: 15px">
                <h3 class="text-center">Add the Movie Book details!! </h3>
            </div>
<!--            <div  v-for="(movie,index) in movies" :key="index">-->
<!--                <h3>{{movie.title}}</h3>-->
<!--            </div>-->
            <label for="username">UserNames</label>
            <input
                type="text"
                id="username"
                v-model="username"
                placeholder="Enter Username"
                class="form-control">
        </div>
    <div class="form-group container w-50 my-2">
        <label>Select showTime:</label>
        <select class='form-control' id="showtimes" v-model='showtime' >
            <option v-for="item in showtimes" :value="item.id">{{item.showtime}}</option>
        </select>
    </div>
    <div class="container w-50 my-2">
        <label>Select Show Date :</label>
        <input class="form-control" id="date" type="date" @change="getBookedSeat" v-model="showtimedate"
               name="show_time_date">
    </div>
    <div class="container p-1" style="min-height:500px;border-radius:5px;background-color: #80ced6;">

        <div class="alert alert-danger text-center" v-if="errorMessage">{{ errorMessage }}</div>
        <div class="d-flex bd-highlight justify-content-center flex-wrap" id="content">
            <div v-for="box in 101" @click="getSeats(box)" v-model="selectedSeats" :id="box" :value="box"
                 class="border p-2 m-3 text-center"
                 style="width: 75px;">{{ box }}
            </div>
            {{selectedSeats}}        </div>
    </div><br>
    <div align="center">
    <button type="button" id="btnBook"  @click="addBookTickets" class="btn btn-primary ">
BookMovie
    </button>
        <div class="alert alert-success text-center" v-if="successMessage">{{ successMessage }}</div>
    </div>

</div>
</template>

<script>
import Directory from "./admin/movieCreate";
export default {
    name: "bookmovie",
    components: {Directory},
    data: function () {
        return {
            showtime:"",
            showtimes:[],
            showtimedate:"",
            seats: [],
            username:"",
            selectedSeats: [],
            onlySeats: [],
            movies:[],
            m_id:[],


        }

        },
    methods: {
        getshowtime: function () {
            axios.get('/api/getshowtime')
                .then(response => {
                    this.showtimes = response.data
                    // this.casts = this.casts[0]
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getMovie: function () {
            axios.get('/api/getMovie/'+id)
                .then(response => {
                    this.movies = response.data
                    this.movies = this.movies[0]
                })
                .catch(error => {
                    console.log(error);
                })

        },
        addBookTickets() {
            axios.post('/api/save_book', {
                username: this.username,
                showtime: this.showtime,
                showtimedate: this.showtimedate,
                seats: this.selectedSeats,
            })
                .then(res => {
                    this.username = [],
                        this.showtime = "",
                        this.showtimedate = "",
                        this.seats = [],
                        this.getBookedSeat();
                    this.successMessage = "Your seat is booked successfully";
                })
        },
        getBookedSeat: function () {
            const data = {
                username :this.username,
                showtime: this.showtime,
                showtimedate:this.showtimedate,
                seats : this.seats,
            }
            axios.post('/api/getSeats', data)
                .then(response => {
                    this.seats = response.data;
                    let str = "";
                    this.onlySeats = [];
                    for (let i = 0; i < this.seats.length; i++) {
                        for (let j = 0; j < this.seats[i].seats.length; j++) {
                            if (this.seats[i].seats[j] === "|") {
                                    this.onlySeats.push(str);
                                str = "";
                                continue;
                            } else {
                                str += this.seats[i].seats[j];
                            }
                        }
                        this.onlySeats.push(str);
                        str = "";
                    }
                    this.closeBookedSeat();
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getSeats: function (seat) {
            if ($("#" + seat).hasClass("bg-danger text-light")) {
                alert("This seat is already booked! Please Choose another seat!");
            } else {
                if ($("#" + seat).hasClass("bg-light text-dark")) {
                    if (this.selectedSeats.length === 10) {
                        alert("you can select maximum 10 tickets");
                    } else {
                        $("#" + seat).removeClass("bg-light text-dark");
                        $("#" + seat).addClass("bg-dark text-light");
                        this.selectedSeats.push(seat);
                    }
                } else {
                    $("#" + seat).removeClass("bg-dark text-light");
                    $("#" + seat).addClass("bg-light text-dark");
                    this.selectedSeats.pop(seat);

                }
            }
        },
        closeBookedSeat: function () {
            if (this.onlySeats.length === 101) {
                this.errorMessage = "This Show is full";
            }
            for (let i = 0; i <= 101; i++) {
                if (this.onlySeats.includes(i.toString())) {
                    if ($("#" + i).hasClass("bg-dark text-light")) {
                        $("#" + i).removeClass("bg-dark text-light");
                    }
                    if ($("#" + i).hasClass("bg-light text-dark")) {
                        $("#" + i).removeClass("bg-light text-dark");
                        }
                    $("#" + i).addClass("bg-danger text-light");
                } else {
                    if ($("#" + i).hasClass("bg-danger text-light")) {
                        $("#" + i).removeClass("bg-danger text-light");
                    }
                    $("#" + i).addClass("bg-light text-dark");
                }
            }
        }

    },
    created() {
       // this.fetchAll();
        this.getshowtime();
        this.getBookedSeat();
        this.getMovie();

    }
}

</script>

<style scoped>

</style>
