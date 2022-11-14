import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import auth from "./auth";
import order from "./order";

const store = createStore({
    state: {
        noti: false,
    },
    getters: {},
    actions: {
        noti({ commit }, status) {
            commit("NOTI_STATUS", status);
        },
    },
    mutations: {
        NOTI_STATUS(state, status) {
            state.noti = status;
        },
    },
    modules: {
        auth,
        order,
    },
    plugins: [
        createPersistedState({
            paths: ["auth"],
        }),
    ],
});

export default store;
