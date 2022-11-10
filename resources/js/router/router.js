import { createRouter, createWebHistory } from "vue-router";
import Home from "../icecream/Home.vue";
import Login from "../icecream/auth/Login.vue";
import Register from "../icecream/auth/Register.vue";
import Profile from "../icecream/auth/Profile.vue";
import store from "../store/store";

const routes = [
    { path: "/", name: "Home", component: Home },
    { path: "/login", name: "Login", component: Login },
    {
        path: "/register",
        name: "Register",
        component: Register,
    },
    {
        path: "/profile",
        name: "Profile",
        component: Profile,
        beforeEnter: isLoggedIn,
    },
];

function isLoggedIn(to, from, next) {
    if (store.getters["auth/authenticated"] == null) {
        next({
            name: "Login",
        });
    }
    next();
}

function guest(to, from, next) {
    if (store.getters["auth/authenticated"] !== null) {
        next({
            name: "Home",
        });
    }
    next({
        name: "Login",
    });
}

const router = createRouter({
    routes,
    history: createWebHistory(),
});

export default router;
