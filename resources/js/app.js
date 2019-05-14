require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Axios from 'axios';

Vue.use(VueRouter,VueAxios,Axios);

// route target
import AppComponent from './components/AppComponent.vue';
import PersonListComponent from './components/person/PersonListComponent.vue';
import PersonAddComponent from './components/person/PersonAddComponent.vue';
import PersonUpdateComponent from './components/person/PersonUpdateComponent.vue';
import PersonListSearchComponent from './components/person/PersonListSearchComponent.vue';

const routes = [
    {
        name:'Person List',
        path:'/',
        component: PersonListComponent
    },
    {
        name:'Person Add',
        path:'/create',
        component: PersonAddComponent
    },
    {
        name:'Person Update',
        path:'/update/:id',
        component: PersonUpdateComponent
    },
    {
        name:'Person Search',
        path:'/search',
        component: PersonListSearchComponent
    }
];

const router = new VueRouter({ mode: 'history', routes: routes });
new Vue(Vue.util.extend({ router }, AppComponent)).$mount("#app");
