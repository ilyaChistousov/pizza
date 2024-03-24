import {defineStore} from "pinia";
import axios from "../api"

export const useCartStore = defineStore('cartStore', {
    state: () => ({
        products: [],
    }),
    getters: {
        totalPrice: (state) => {
            return Object.values(state.products).reduce((total, product) =>
                total + product.price * product.quantity
            , 0)
        },
        getProducts: (state) => {
            state.products = JSON.parse(localStorage.getItem('products'))
            return state.products
        }
    },
    actions: {
        addProduct(product) {
            if (localStorage.getItem('products')) {
                this.products = JSON.parse(localStorage.getItem('products'))
            } else {
                this.products = []
            }
            const existingProduct = this.checkExist(product)
            if (existingProduct) {
                existingProduct.quantity++
            } else {
                product.quantity = 1
                this.products.push(product)
            }
            console.log(existingProduct)
            localStorage.setItem('products', JSON.stringify(this.products))
        },
        removeProduct(product) {
            if (localStorage.getItem('products')) {
                this.products = JSON.parse(localStorage.getItem('products'))
            }else {
                this.products = []
            }
            const existingProduct = this.checkExist(product)
            if (existingProduct) {
                if (existingProduct.quantity > 1) {
                    existingProduct.quantity--
                } else {
                    console.log(this.products)
                    this.products.splice(this.products.indexOf(existingProduct), 1)
                    console.log(this.products)
                }
            }
            localStorage.setItem('products', JSON.stringify(this.products))
        },
        checkExist(product) {
            if (this.products) {
                return this.products.find((p) => p.id === product.id && p.size === product.size)
            }
            return null
        },

        async placeOrder(fields, callback) {
            const order = {
                ...fields,
                total: this.totalPrice,
                products: this.products
            }
            console.log(JSON.stringify(order))
            await axios.post('orders', order)
                .then(() => {
                    localStorage.removeItem('products')
                    this.products = []
                    callback()
                })
                .catch((e) => console.log(e))
        }
    }
})