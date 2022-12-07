import './bootstrap';

import {createApp} from 'vue'
import { createRouter, createWebHistory } from 'vue-router'

import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';

import App from './App.vue'
import Index from './Index.vue'
import Test from './Test.vue'

const routes = [
    { 
        path: '/', 
        component: Index 
    },
    { 
        path: '/test', 
        component: Test 
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

const app = createApp(App)

createApp(App).mount("#app")

app.use(router)
app.use(Antd)

app.mount("#app")