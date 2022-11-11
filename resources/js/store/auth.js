import axios from "axios";

export default {
    namespaced: true,
    state: {
        token: null,
        user: null,
        errorMessage: [],
        resError: "",
    },
    mutations: {
        AUTH_TOKEN(state, token) {
            state.token = token;
        },
        SET_USER(state, user) {
            state.user = user;
        },
    },
    actions: {
        async signIn({ dispatch, state }, data) {
            await axios
                .post("api/login", data)
                .then((res) => {
                    state.resError = res.data.error;
                    state.errorMessage = [];
                    return dispatch("attempt", res.data.token);
                })
                .catch((error) => {
                    state.errorMessage = error.response.data.errors;
                    state.resError = "";
                });
        },

        async attempt({ commit, state }, token) {
            if (token) {
                commit("AUTH_TOKEN", token);
            }

            try {
                if (state.token) {
                    const response = await axios.get("api/user", {
                        headers: {
                            Authorization: "Bearer " + token,
                        },
                    });
                    commit("SET_USER", response.data);
                }
            } catch (error) {
                commit("AUTH_TOKEN", null);
                commit("SET_USER", null);
            }
        },
        async logOut({ commit, state }) {
            return await axios
                .get("api/logout", {
                    headers: {
                        Authorization: "Bearer " + state.token,
                    },
                })
                .then(() => {
                    commit("AUTH_TOKEN", null);
                    commit("SET_USER", null);
                });
        },
    },
    getters: {
        authenticated(state) {
            return state.token && state.user;
        },
        user(state) {
            return state.user;
        },

        errorMessages(state) {
            return state.errorMessage;
        },

        resErrorMessage(state) {
            return state.resError;
        },
    },
};
