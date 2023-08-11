import * as VueRouter from "vue-router";

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory('/'),
    routes: [

        {
            path: '/get',
            name: 'get',
            component: () => import('./components/Get.vue')
        },


        {
            path: '/dropzone',
            name: 'dropzone',
            component: () => import('./components/Dropzone.vue')
        },

        {
            path: '/posts',
            name: 'posts',
            component: () => import('./pages/Posts.vue')
        },

        {
            path: '/personal',
            name: 'user.personal',
            component: () => import('./components/Personal.vue')
        },

        {
            path: '/user/login',
            name: 'user.login',
            component: () => import('./components/Login.vue')
        },
        {
            path: '/user/registration',
            name: 'user.registration',
            component: () => import('./components/Registration.vue')
        },

        {
            path: '/',
            name: 'home',
            component: () => import('./pages/Home.vue')
        },
        {
            path: '/about',
            name: 'about',
            component: () => import('./pages/About.vue')
        }
    ]

})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x_xsrf_token')

    if (!token){
        if (to.name === 'user.login' || to.name === 'user.registration'){
            return next()
        } else{
            return next({name: 'user.login'})
        }
    }

    if (to.name === 'user.login' || to.name === 'user.registration' && token){
        return next({name: 'home'})
    }

    next()
})

export default router
