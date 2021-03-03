import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)


//modules
import categories from './modules/categories'
import brands from './modules/brands'
import sizes from './modules/sizes'
import products from './modules/products'

export default new Vuex.Store({
    modules: {
        categories,
        brands,
        sizes,
        products
    }
})
