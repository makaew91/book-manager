import { createWebHistory, createRouter } from "vue-router";
import store from '../store'
import Auth from "../pages/Auth";
import Users from "../pages/Users";
import NotFound from "../pages/404"


const routes = [
    {
        path: "/",
        name: "Users",
        component: Users,
        meta: {
            layout: 'main',
            auth: true
        }
    },
    {
        path: "/login",
        name: "Auth",
        component: Auth,
        meta: {
            layout: 'auth',
            auth: false
        }
    },
    {
        path: "/:catchAll(.*)",
        name: "NotFound",
        component: NotFound,
        meta: {
            layout: 'main',
            auth: false
        }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const requireAuth = to.meta.auth

    if (requireAuth && store.getters['auth/isAuthenticated']) {
        next()
    } else if (requireAuth && !store.getters['auth/isAuthenticated']) {
        next('/login?message=auth')
    } else {
        next()
    }
})

export default router;
