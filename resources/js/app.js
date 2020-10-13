require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from "./store/index"

const store = new Vuex.Store(
   storeData
)


Vue.component('add-product', require('./components/AddProduct.vue').default);
Vue.component('all-products', require('./components/AllProducts.vue').default);


const app = new Vue({
    el: '#app',
    store
});
