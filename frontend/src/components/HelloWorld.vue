<script setup>
import {ref} from 'vue'
import axios from 'axios'

axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

const count = ref(0)
const form = ref({
  name: 'newName',
  email: 'test@test.com',
  password: 'password',
  phone: '8800553535',
})

const user = ref()
const cookie = ref()

async function onLogin() {
  let {xcrf} = await axios.get("http://localhost:80/sanctum/csrf-cookie");
  cookie.value = xcrf

  let {data} = await axios.post("http://localhost:80/register", {
    name: form.value.name,
    email: form.value.email,
    password: form.value.password,
    phone: form.value.phone
  });

  user.value = data
}
</script>

<template>
  <div>{{ cookie }}</div>
  <div>{{ user }} </div>
  <form @submit.prevent="onLogin">
    <div>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" v-model="form.name">
    </div>
    <div>
      <label for="email">Email</label>
      <input type="email" name="email" id="email" v-model="form.email">
    </div>
    <div>
      <label for="password">Password</label>
      <input type="password" name="password" id="password" v-model="form.password">
    </div>
    <div>
      <label for="phone">Phone</label>
      <input type="text" name="phone" id="phone" v-model="form.phone">
    </div>
    <button type="submit">Login</button>
  </form>
</template>

<style scoped>
.read-the-docs {
  color: #888;
}
</style>
