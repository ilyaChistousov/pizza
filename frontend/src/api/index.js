import axios from "axios";

axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

export default axios.create({
    baseURL: 'http://localhost/api',
    headers: {
        'Content-Type': 'application/json',
    }
})