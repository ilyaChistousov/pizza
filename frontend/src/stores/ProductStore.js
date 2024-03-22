import {defineStore} from "pinia";
import axios from "../api"

export const useProductStore = defineStore('productStore', {
    state: () => ({
        products: []
    }),
    getters: {
        getProducts: (state) => state.products
    },
    actions: {
        async fetchProducts() {
            const response = await axios.get('products').catch((error) =>
                console.log(error)
            )
            this.products = response.data
            console.log('products', this.products)
            this.products = response.data.map((product) => {
                return {
                    ...product,
                    price: product.price.filter((price) => price.size === 'small')[0].price,
                }
            })
        }
    },

})