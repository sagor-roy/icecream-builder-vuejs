import axios from "axios";

export default {
    namespaced: true,
    state: {
        token: null,
        user: null,
    },
    mutations: {
        AUTH_TOKEN(state, token) {
            state.token = token;
        },
        SET_USER(state, user) {
            state.user = user.data;
        },
    },
    actions: {
        async signIn({ dispatch }, data) {
            const response = await axios.post("api/login", data);
            return dispatch("attempt", response.data.data.token);
        },

        async attempt({ commit, state }, token) {
            if (token) {
                commit("AUTH_TOKEN", token);
            }

            if (!state.token) {
                return false;
            }
            try {
                const response = await axios.get("api/user", {
                    headers: {
                        ["Authorization"]: "Bearer " + token,
                    },
                });
                commit("SET_USER", response.data);
            } catch (error) {
                commit("AUTH_TOKEN", null);
                commit("SET_USER", null);
            }
        },
    },
    getters: {
        authenticated(state) {
            return state.token && state.user;
        },
        user(state) {
            return state.user;
        },
    },
};
