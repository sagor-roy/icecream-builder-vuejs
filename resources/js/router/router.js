import { createRouter, createWebHistory } from "vue-router";
import Home from "../icecream/Home.vue";
import Login from "../icecream/auth/Login.vue";
import Register from "../icecream/auth/Register.vue";
import Profile from "../icecream/auth/Profile.vue";
import store from "../store/store";

const auth = (to, from, next) => {
    if (!store.getters.authentication) {
        return next({ name: "Login" });
    }
    return next();
};

const guest = (to, from, next) => {
    if (store.getters.authentication) {
        return next({ name: "Profile" });
    }
    return next();
};

const routes = [
    { path: "/", name: "Home", component: Home },
    {
        path: "/login",
        name: "Login",
        component: Login,
        beforeEnter: guest,
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
        beforeEnter: guest,
    },
    {
        path: "/profile",
        name: "Profile",
        component: Profile,
        beforeEnter: auth,
    },
];

const router = createRouter({
    routes,
    history: createWebHistory(),
});

export default router;
