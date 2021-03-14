import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

const indexBola = require('./pages/bola/index.vue').default;
import dataBola from './pages/bola/data'
import tambahBola from './pages/bola/create'
import editBola from './pages/bola/edit'

const routes = [       
    {
        path: '/bola',
        name: 'index.bola',
        component: indexBola,       
        children: [
            {
                path: '',
                name: 'data.bola',
                component: dataBola,
                meta: { title: 'atur bola' }
            },
            {
                path: 'tambah',
                name: 'tambah.bola',
                component: tambahBola,
                meta: { title: 'tambahbola' }
            },
            //kodingan edit
            {
                path: 'edit/:id',
                name: 'edit.bola',
                component: editBola,
                meta: { title: 'Edit bola' }
            }
        ]
    },  
       
]

const router = new VueRouter ({
    mode : 'history',
    routes : routes
 
});

export default router