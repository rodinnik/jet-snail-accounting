import { createStore } from "vuex";
import axios from "axios";

const store = createStore({
    state: { token: localStorage.getItem("token") || "", user: {} },
    getters: {
        isLoggedIn: (state) => !!state.token,
    },
    mutations: {
        auth_success(state, token, user) {
            state.token = token;
            state.user = user;
        },
        logout(state) {
            state.token = "";
        },
    },
    actions: {
        login({ commit }, user) {
            return new Promise((resolve, reject) => {
                axios
                    .post("http://127.0.0.1:8000/api/login", user)
                    .then((response) => {
                        const token = response.data.access_token;
                        const user = response.data.user;
                        localStorage.setItem("token", token);
                        axios.defaults.headers.common["Authorization"] =
                            "Bearer " + token;
                        commit("auth_success", token, user);
                        resolve(response);
                    })
                    .catch((error) => {
                        localStorage.removeItem("token");
                        reject(error);
                    });
            });
        },
        register({ commit }, user) {
            return new Promise((resolve, reject) => {
                axios
                    .post("http://127.0.0.1:8000/api/register", user)
                    .then((response) => {
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .post("http://127.0.0.1:8000/api/logout")
                    .then(({ data }) => {
                        commit("logout");
                        localStorage.removeItem("token");
                        delete axios.defaults.headers.common["Authorization"];
                        resolve();
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
    },
});

export default store;
