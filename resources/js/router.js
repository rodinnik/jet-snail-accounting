import { createWebHistory, createRouter } from "vue-router";
import store from "./store";

import Login from "./pages/Login.vue";
import Register from "./pages/Register.vue";
import AccountingPanel from "./pages/AccountingPanel.vue";
import ContentMain from "./pages/ContentMain.vue";

const routes = [
    {
        path: "/login",
        component: Login,
        name: "Login",
    },
    {
        path: "/register",
        component: Register,
        name: "Register",
    },
    {
        path: "/accounting",
        component: AccountingPanel,
        name: "AccountingPanel",
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/",
        component: ContentMain,
        name: "ContentMain",
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next();
            return;
        } else {
            router.push("/login");
        }
    } else {
        next();
    }
});

export default router;
