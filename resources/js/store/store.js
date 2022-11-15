import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import auth from "./auth";

const store = createStore({
    state: {},
    getters: {},
    actions: {},
    mutations: {},
    modules: {
        auth,
    },
    plugins: [
        createPersistedState({
            paths: ["auth"],
        }),
    ],
});

export default store;
