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

const routes = [
    {
        path: '/',
        name: 'home',
        component: home,
        meta: {
            auth: true,
            admin: 0,
        },
    },
    {
        path: '/admin/home',
        component:admin,
        name:admin,
        meta: {
            auth: true,
            admin: 1,
        },
    },
    {
        path: '/casts',
        component:casts,
        name:casts,
        meta: {
            auth: true,
            admin: 1,
        },

    },
    {
        path: '/dashboard',
        component:dashboard,
        name:dashboard,
        meta: {
            auth: true,
            admin: 1,
        },
    },
    {
        path: '/movies',
        component: () => import('../components/admin/movies.vue'),
        name:movies,
        meta: {
            auth: true,
            admin: 1,
        },
    },

    {
        path: '/theatres',
        component:theatres,
        name:theatres,
        meta: {
            auth: true,
            admin: 1,
        },
    },
    {
        path: '/movieCreate',
        component:movieCreate,
        name:movieCreate,
        meta: {
            auth: true,
            admin: 1,
        },
    },
    {
        path: '/theatresDetail',
        component:theatresDetail,
        name:theatresDetail,
        meta: {
            auth: true,
            admin: 0,
        },
    },
    {
        path: '/bookmovie',
        component:bookmovie,
        name:bookmovie,
        meta: {
            auth: true,
            admin: 0,
        },
    },
    {
        path: '/moviecast',
        component:moviecast,
        name:moviecast,
        meta: {
            auth: true,
            admin: 1,
        },
    },
    {
        path: '/moviecastsdetail',
        component:moviecastsdetail,
        name:moviecastsdetail,
        meta: {
            auth: true,
            admin: 0,
        },
    },
    {
        path: '/movieTheatre',
        component:movieTheatre,
        name:movieTheatre,
        meta: {
            auth: true,
            admin: 1,
        },
    },
    {
        path: '/city',
        component:city,
        name:city,
        meta: {
            auth: true,
            admin: 1,
        },
    },
    {
        path: '/login',
        name:login,
        component: () => import('../components/login.vue'),
    },
    {
        path: '/register',
        name:register,
        component: () => import('../components/register.vue'),
    },

];

export default routes;
