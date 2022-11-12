import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import auth from "./auth";

const store = createStore({
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
