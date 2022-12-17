import { createApp } from "vue";

import router from "./router.js";
import store from "./store";
import App from "./App.vue";

import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

import axios from "axios";
if (localStorage.getItem("token")) {
    axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("token");
}

const vuetify = createVuetify({
    components,
    directives,
});

createApp(App).use(router).use(store).use(vuetify).mount("#app");
