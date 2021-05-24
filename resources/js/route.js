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
        path: '/theatresDetail',
        component:theatresDetail,
        name:theatresDetail,
    },
    {
        path: '/bookmovie',
        component:bookmovie,
        name:bookmovie,
    },
    {
        path: '/moviecast',
        component:moviecast,
        name:moviecast,
    },
    {
        path: '/moviecastsdetail',
        component:moviecastsdetail,
        name:moviecastsdetail,
    },

];

export default routes;
