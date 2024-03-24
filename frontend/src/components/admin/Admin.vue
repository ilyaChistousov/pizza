<script setup>
import ProductsSection from "./ProductsSection.vue";
import {ref} from "vue";
import OrdersSection from "./OrdersSection.vue";
import UsersSection from "./UsersSection.vue";
const activeSection = ref('products');
</script>

<template>
  <router-link to="/" class="block mt-4 text-blue-500 hover:underline">Назад</router-link>
    <div class="bg-gray-100 min-h-screen flex flex-col">
      <header class="bg-blue-500 p-4 text-white">
        <h1 class="text-2xl font-semibold">Админ панель</h1>
      </header>

      <nav class="flex justify-center mt-4 space-x-4">
        <button @click="activeSection = 'products'" :class="{ 'bg-blue-600': activeSection === 'products', 'bg-blue-400 hover:bg-blue-600': activeSection !== 'products' }" class="px-4 py-2 rounded-md text-white font-semibold">Продукты</button>
        <button @click="activeSection = 'users'" :class="{ 'bg-blue-600': activeSection === 'users', 'bg-blue-400 hover:bg-blue-600': activeSection !== 'users' }" class="px-4 py-2 rounded-md text-white font-semibold">Пользователи</button>
        <button @click="activeSection = 'orders'" :class="{ 'bg-blue-600': activeSection === 'orders', 'bg-blue-400 hover:bg-blue-600': activeSection !== 'orders' }" class="px-4 py-2 rounded-md text-white font-semibold">Заказы</button></nav>

      <div class="flex-grow mt-4 px-4">
        <ProductsSection v-if="activeSection === 'products'" />
        <OrdersSection v-else-if="activeSection === 'orders'" />
        <UsersSection v-else-if="activeSection === 'users'" />
      </div>
    </div>
</template>

<style scoped>

</style>