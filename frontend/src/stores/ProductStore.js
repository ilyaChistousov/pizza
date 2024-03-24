import {defineStore} from "pinia";
import axios from "../api"

export const useProductStore = defineStore('productStore', {
    state: () => ({
        products: [],
        product: {}
    }),
    getters: {
        getProducts: (state) => state.products,
        getProduct: (state, id) => {
            return (id) => state.products.find(product => product.id === id)
        }
    },
    actions: {
        async fetchOneProduct(id) {
            const response = await axios.get(`products/${id}`).catch((error) =>
                console.log(error)
            )
            this.product = response.data
        },

        async fetchProducts() {
            const response = await axios.get('products').catch((error) =>
                console.log(error)
            )
            const data = response.data.map((product) => {
                return {
                    ...product,
                    price: product.price.filter((price) => price.size === 'small')[0].price,
                }
            })

            this.setProductsGroup(data);
        },
        setProductsGroup(products) {
                const renamedCategories = {
                    'pizza': 'Пиццы',
                    'drink': 'Напитки',

                }
                const grouped = {}
                products.forEach(product => {
                    const category = renamedCategories[product.category] || product.category
                    if (!grouped[category]) {
                        grouped[category] = {name: category, products: []}
                    }
                    grouped[category].products.push(product)
                })
                this.products = Object.values(grouped)
            }
    },

})