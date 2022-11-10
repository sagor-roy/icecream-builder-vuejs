import "./bootstrap";
import { createApp } from "vue";
import "./assets/styles.css";
import store from "./store/store.js";
import router from "./router/router.js";
// import "bootstrap/dist/css/bootstrap.min.css";
import "@fortawesome/fontawesome-free/css/all.min.css";
// import App from "./App.vue";
import App from "./icecream/App.vue";
import("./store/subscriber.js");
//import Login from "./icecream/auth/Login.vue";
// import App from "./Apps.vue";

store.dispatch("auth/attempt", localStorage.getItem("token")).then(() => {
    createApp(App).use(store).use(router).mount("#app");
});
