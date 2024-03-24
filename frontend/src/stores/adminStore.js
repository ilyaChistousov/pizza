import {defineStore} from "pinia";
import axios from "../api"

export const useAdminStore = defineStore('adminStore', {
    state: () => ({
        users: [],
        products: [],
        orders: [],
        errors: [],
        categories: []
    }),
    actions: {
        async fetchUsers() {
           try{
               const response = await axios.get('users')
               this.users = response.data
           } catch (e) {
               this.errors = this.parseError(e)
           }
        },
        async deleteUser(userId) {
            try{
                await axios.delete(`users/${userId}`)
                this.users = this.users.filter(user => user.id !== userId)
            } catch (e) {
                this.errors = this.parseError(e)
            }
        },
        async fetchProducts() {
            try{
                const response = await axios.get('products')
                this.products = response.data
            } catch (e) {
                this.errors = this.parseError(e)
            }
        },
        async updateProduct(productId, formData, callback) {
            try{
                await axios.post(`products/${productId}`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                callback()
            } catch (e) {
                this.errors = this.parseError(e)
            }
        },
        async createProduct(formData, callback) {
            try{
                await axios.post('products', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                callback()
            } catch (e) {
                this.errors = this.parseError(e)
            }
        },
        async deleteProduct(productId) {
            try{
                await axios.delete(`products/${productId}`)
                this.products = this.products.filter(product => product.id !== productId)
            } catch (e) {
                this.errors = this.parseError(e)
            }
        },
        async fetchOrders() {
            try{
                const response = await axios.get('orders')
                this.orders = response.data
            } catch (e) {
                this.errors = this.parseError(e)
            }
        },
        async changeStatusOrder(id, data) {
            try {
                await axios.put(`orders/${id}`, data)
            } catch (e) {
                this.errors = this.parseError(e)
            }
        },
        async fetchCategories() {
            try{
                const response = await axios.get('categories')
                this.categories = response.data
            } catch (e) {
                this.errors = this.parseError(e)
            }
        },
        parseError(error) {
            console.log(error)
            return Object.entries(error.response.data.errors).reduce((acc, value, ) => {
                acc[value[0]] = value[1]
                return acc
            }, {})
        }
    }
})