<script setup>

import {computed, ref, watch} from "vue";
import {useUserStore} from "../../stores/userStore.js";
import {useRouter} from "vue-router";

const userStore = useUserStore()
const router = useRouter()
const error = computed(() => userStore.error)

const fields = ref({
  'name': 'asda',
  'email': 'asdaa@asdasd',
  'password': '12345678',
  'password_confirmation': '12345678',
  'phone': '88005553333'
})

const register = () => {
  userStore.register(fields.value, () => router.push('/'))
}
</script>

<template>
  <div class="bg-white p-8 rounded-xl max-w-lg">
    <h2 class="text-xl font-semibold mb-4">Регистрация</h2>
    <form @submit.prevent="register">
      <label for="name" class="block mb-2">Имя:</label>
      <input v-model="fields.name" id="name" type="text" class="border-gray-300 rounded-md p-2 mb-4 w-full" placeholder="Имя" required>
      <div v-if="error" class="text-red-500 mb-2" v-for="message in error.name">{{ message }}</div>

      <label for="password" class="block mb-2">Пароль:</label>
      <input v-model="fields.password" id="password" type="text" class="border-gray-300 rounded-md p-2 mb-4 w-full" placeholder="Password" required>
      <div v-if="error" class="text-red-500 mb-2" v-for="message in error.password">{{ message }}</div>

      <label for="password_confirmation" class="block mb-2">Подтверждение пароля:</label>
      <input v-model="fields.password_confirmation" id="password_confirmation" type="text" class="border-gray-300 rounded-md p-2 mb-4 w-full" placeholder="Потвердите пароль" required>

      <label for="phone" class="block mb-2">Номер телефона:</label>
      <input v-model="fields.phone" id="phone" type="text" class="border-gray-300 rounded-md p-2 mb-4 w-full" placeholder="Телефон" required>
      <div v-if="error" class="text-red-500 mb-2" v-for="message in error.phone">{{ message }}</div>

      <label for="email" class="block mb-2">Email:</label>
      <input v-model="fields.email" id="email" type="text" class="border-gray-300 rounded-md p-2 mb-4 w-full" placeholder="Email" required>
      <div v-if="error" class="text-red-500 mb-2" v-for="message in error.email">{{ message }}</div>

      <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-full border border-blue-500 hover:bg-blue-600 hover:text-white">Зарегистрироваться</button>

      <router-link to="/" class="block mt-4 text-blue-500 hover:underline">Назад</router-link>
    </form>
  </div>
</template>
