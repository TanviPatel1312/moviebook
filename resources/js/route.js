import home from './components/home'
import theatresDetail from './components/theatresDetail'
import bookmovie from './components/bookmovie'
import admin from "./components/admin/admin";
import movies from "./components/admin/movies";
import theatres from "./components/admin/theatres";
import dashboard from "./components/admin/dashboard";
import casts from "./components/admin/casts";
import moviecast from "./components/admin/moviecast";
import movieCreate from "./components/admin/movieCreate";
import moviecastsdetail from "./components/moviecastsdetail";
import movieTheatre from "./components/admin/movieTheatre";
import city from "./components/admin/city";
import login from "./components/login";
import register from "./components/register";
import displayBookTicket from "./components/displayBookTicket";
import showtime from "./components/admin/showtime";
import displaymoviebook from "./components/admin/displaymoviebook";

const routes = [
    {
        path: '/',
        name: 'home',
        component: home,
    },
    {
        path: '/admin/home',
        component:admin,
        name:admin,
    },
    {
        path: '/casts',
        component:casts,
        name:casts
    },
    {
        path: '/dashboard',
        component:dashboard,
        name:dashboard,
    },
    {
        path: '/movies',
        component:movies,
        name:movies,
    },

    {
        path: '/theatres',
        component:theatres,
        name:theatres,
    },
    {
        path: '/movieCreate',
        component:movieCreate,
        name:movieCreate,
    },
    {
        path: '/theatresDetail/:id',
        component:theatresDetail,
        name:theatresDetail,
    },
    {
        path: '/bookmovie/:id',
        component:bookmovie,
        name:bookmovie,
    },
    {
        path: '/moviecast',
        component:moviecast,
        name:moviecast,
    },
    {
        path: '/moviecastsdetail/:id',
        component:moviecastsdetail,
        name:moviecastsdetail,
    },
    {
        path: '/movieTheatre',
        component:movieTheatre,
        name:movieTheatre,
    },
    {
        path: '/city',
        component:city,
        name:city,
    },
    {
        path: '/login',
        component:login,
        name:login,
    },
    {
        path: '/register',
        component:register,
        name:register,
    },
    {
        path: '/displayBookTicket',
        component:displayBookTicket,
        name:displayBookTicket,
    },
    {
        path: '/showtime',
        component:showtime,
        name:showtime,
    },
    {
        path: '/displaymoviebook',
        component:displaymoviebook,
        name:displaymoviebook,
    },

];

export default routes;
