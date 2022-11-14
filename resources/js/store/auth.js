import axios from "axios";

export default {
    state: {
        auth_status: false,
        token: null,
        info: {
            id: "",
            name: "",
            email: "",
            img: "",
        },
    },
    mutations: {
        AUTH_TOKEN(state, token) {
            state.token = token;
            state.auth_status = true;
        },
        SET_USER(state, data) {
            state.info.id = data.id;
            state.info.name = data.name;
            state.info.email = data.email;
            state.info.img = data.img;
        },
        UPDATE_PROFILE(state, data) {
            state.info.name = data.data.name;
            state.info.email = data.data.email;
            state.info.img = data.data.img;
        },
    },
    actions: {
        login({ dispatch, commit }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post("api/login", data)
                    .then((res) => {
                        resolve(res);
                        if (res.data.status) {
                            commit("AUTH_TOKEN", res.data.token);
                            return dispatch("attempt", res.data.token);
                        }
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        register({ dispatch, commit }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post("api/register", data)
                    .then((res) => {
                        resolve(res);
                        if (res.data.status) {
                            commit("AUTH_TOKEN", res.data.token);
                            return dispatch("attempt", res.data.token);
                        }
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        async attempt({ commit, state }, token) {
            try {
                if (state.token) {
                    const response = await axios.get("api/user", {
                        headers: {
                            Authorization: "Bearer " + token,
                        },
                    });
                    commit("AUTH_TOKEN", token);
                    commit("SET_USER", response.data);
                }
            } catch (error) {
                commit("AUTH_TOKEN", null);
                commit("SET_USER", null);
            }
        },
        update({ commit }, data) {
            commit("UPDATE_PROFILE", data);
        },
        logout({ state }) {
            return new Promise((resolve, reject) => {
                axios
                    .get("api/logout")
                    .then((res) => {
                        resolve(res);
                        state.token = null;
                        state.auth_status = null;
                        state.info = {};
                        localStorage.removeItem("vuex");
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
    },
    getters: {
        authentication(state) {
            return state.auth_status;
        },
        token(state) {
            return state.token;
        },
        user(state) {
            return state.info;
        },
    },
};
