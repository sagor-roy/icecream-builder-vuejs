import "./bootstrap";
import { createApp } from "vue";
import "./assets/styles.css";
import store from "./store/store.js";
import router from "./router/router.js";
import "bootstrap/dist/css/bootstrap.min.css";
import "@fortawesome/fontawesome-free/css/all.min.css";
// import App from "./App.vue";
import App from "./icecream/App.vue";
import axios from "axios";
import mitt from "mitt";
const emitter = mitt();
//import Login from "./icecream/auth/Login.vue";
// import App from "./Apps.vue";

axios.defaults.headers.common["Authorization"] =
    "Bearer " + store.getters.token;

const app = createApp(App);
app.config.globalProperties.emitter = emitter;
app.use(store);
app.use(router);
app.mount("#app");
