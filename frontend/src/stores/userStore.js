import {defineStore} from "pinia";
import axios from "../api"

export const useUserStore = defineStore('userStore', {
    state: () => ({
        loggedIn: false,
        userId: null,
        user: {},
        error: null
    }),
    getters: {
        isLoggedIn: (state) =>
            localStorage.getItem('loggedIn') === 'true' || state.loggedIn,
    },
    actions: {
        async register(fields, callback) {
            try {
                const response = await axios.post('/register', fields)
                this.userId = response.data.id
                localStorage.setItem('loggedIn', JSON.stringify(true))
                localStorage.setItem('userId', JSON.stringify(response.data.id))
                this.loggedIn = true
                callback()
            } catch (e) {
                this.error = this.parseError(e)
            }
        },
        async login(fields, callback) {
            try {
                const response = await axios.post('/login', fields)
                this.userId = response.data.id
                localStorage.setItem('loggedIn', JSON.stringify(true))
                localStorage.setItem('userId', JSON.stringify(response.data.id))
                this.loggedIn = true
                callback()
            } catch (e) {
                this.error = this.parseError(e)
            }
        },
        async logout(callback) {
            try {
                await axios.post('/logout')
                this.user = {}
                localStorage.removeItem('loggedIn')
                localStorage.removeItem('userId')
                this.loggedIn = false
                callback()
            } catch (e) {
                console.log(e)
            }
        },
        async fetchUser(userId) {
            try{
                const response = await axios.get(`/users/${userId}`)
                this.user = response.data
            } catch (e) {
                console.log(e)
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