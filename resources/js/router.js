import { createRouter, createWebHashHistory } from "vue-router";
import Start from "./views/Start.vue";

export default createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: "/",
            name: "home",
            component: Start,
        },
    ],
});
