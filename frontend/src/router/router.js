import {createRouter, createWebHistory} from "vue-router";
import {inject} from "vue";
import {useUserStore} from "../stores/userStore.js";

const routes = [
    {
        path: '/',
        component: () => import("../components/product-list/ProductList.vue"),
        name: 'productList',
    },
    {
        path: '/product/:id',
        component: () => import("../components/product-details/ProductDetails.vue"),
        name: 'product',
        props: true
    },
    {
        path: '/cart',
        component: () => import("../components/product-cart/Cart.vue"),
        name: 'cart'
    },
    {
        path: '/register',
        component: () => import("../components/register/Register.vue"),
        name: 'register'
    },
    {
        path: '/profile/:id',
        component: () => import("../components/profile/UserProfile.vue"),
        name: 'profile'
    },
    {
        path: '/admin'
        , component: () => import("../components/admin/Admin.vue"),
        name: 'admin'
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const userStore = useUserStore();

    if (to.name === 'register' && localStorage.getItem('loggedIn')) {
        next({ name: 'productList' });
    }

    if (to.name === 'admin') {
        userStore.fetchUser(localStorage.getItem('userId'))
            .then(() => {
                if (userStore.user.role !== 'admin') {
                    next({ name: 'productList' });
                } else {
                    next();
                }
            })
            .catch((error) => {
                console.error('Ошибка при получении информации о пользователе:', error);
                next({ name: 'productList' });
            });
    } else {
        next();
    }
})

export default router;