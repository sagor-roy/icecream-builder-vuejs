import { createRouter, createWebHistory } from "vue-router";
import Home from "../icecream/Home.vue";
import Login from "../icecream/auth/Login.vue";
import Register from "../icecream/auth/Register.vue";
import Profile from "../icecream/auth/Profile.vue";
import store from "../store/store";
import Layouts from "../icecream/admin/Layouts.vue";
import Dashboard from "../icecream/admin/Dashboard.vue";
import Item from "../icecream/admin/Item.vue";
import Order from "../icecream/admin/Order.vue";
import Create from "../icecream/admin/Create.vue";
import Edit from "../icecream/admin/Edit.vue";

// const auth = (to, from, next) => {
//     if (!store.getters.authentication) {
//         return next({ name: "Login" });
//     }
//     return next();
// };

// const guest = (to, from, next) => {
//     if (store.getters.authentication) {
//         return next({ name: "Profile" });
//     }
//     return next();
// };

const routes = [
    { path: "/", name: "Home", component: Home },
    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: {
            guest: true,
        },
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
        meta: {
            guest: true,
        },
    },
    {
        path: "/profile",
        name: "Profile",
        component: Profile,
        meta: {
            auth: true,
        },
    },
    {
        path: "/admin",
        name: "Layouts",
        component: Layouts,
        redirect: "/admin/dashboard",
        meta: {
            admin: true,
        },
        children: [
            {
                path: "dashboard",
                name: "Dashboard",
                component: Dashboard,
            },
            {
                path: "item",
                component: Item,
            },
            {
                path: "order",
                component: Order,
            },
            {
                path: "item/create",
                component: Create,
            },
            {
                path: "items/:id",
                component: Edit,
            },
        ],
    },
];

const router = createRouter({
    routes,
    history: createWebHistory(),
});

let role = 1;

router.beforeEach((to, from, next) => {
    if (to.meta.auth && !store.getters.token) {
        next({ name: "Login" });
    } else if (to.meta.admin && !store.getters.token) {
        next({ name: "Login" });
    } else {
        next();
    }
});

export default router;
