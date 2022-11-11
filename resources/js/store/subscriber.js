import axios from "axios";
import store from "./store";

store.subscribe((mutation) => {
    switch (mutation.type) {
        case "auth/AUTH_TOKEN":
            if (mutation.payload) {
                axios.defaults.headers.common["Authorization"] =
                    "Bearer " + `${mutation.payload}`;
                localStorage.setItem("token", mutation.payload);
            } else {
                axios.defaults.headers.common["Authorization"] = null;
                localStorage.removeItem("token", null);
            }
            break;

        default:
            break;
    }
});
