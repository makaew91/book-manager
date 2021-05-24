import { createWebHistory, createRouter } from "vue-router";
import Home from "./Pages/Home";
import AppLogin from "./Pages/AppLogin";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/login",
        name: "Login",
        component: AppLogin,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
