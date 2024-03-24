<script setup>
import {useCartStore} from "../../stores/cartStore.js";
import {computed, onMounted, onUpdated, ref} from "vue";
import {useRouter} from "vue-router";
import {useUserStore} from "../../stores/userStore.js";
const router = useRouter();
const store = useCartStore();
const userStore = useUserStore()
const cartProducts = computed(() => store.getProducts)
const totalPrice = computed(() => store.totalPrice)
const user = computed(() => userStore.user)
const fields = ref({
  'phone': '',
  'address': '',
  'email': ''
})

const incrementQuantity = (product) => {
  store.addProduct(product)
}
const decrementQuantity = (product) => {
  store.removeProduct(product)
}

const makeOrder = () => {
  if (fields.value.phone && fields.value.address) {
    store.placeOrder(fields.value, () => router.push('/'))
  } else {
    alert('Пожалуйста, заполните все обязательные поля (номер телефона и адрес)');
  }
}

onMounted(() => {
  if (userStore.isLoggedIn) {
    userStore.fetchUser(localStorage.getItem('userId'))
    fields.value.phone = user.value.phone
    fields.value.email = user.value.email
  }
})
</script>

<template>
  {{user}}
  <router-link to="/" class="block mt-4 text-blue-500 hover:underline">Назад</router-link>
  <div v-if="cartProducts">
    <div v-if="cartProducts.length > 0">
      <h2 class="text-xl font-semibold mb-4">Корзина товаров</h2>
      <div v-for="(product, index) in cartProducts" :key="index" class="border-b pb-4 mb-4">
        <p class="text-lg font-semibold">{{ product.name }}</p>
        <p class="text-gray-600">{{ product.description }}</p>
        <p class="mt-2 text-gray-800">Цена: {{ product.price.price }} ₽</p>
        <div class="mt-2 flex items-center">
          <button @click="decrementQuantity(product)" class="px-2 py-1 bg-red-500 text-white font-semibold rounded-full border border-red-500 hover:bg-red-600 hover:text-white">-</button>
          <p class="mx-2">{{ product.quantity }}</p>
          <button @click="incrementQuantity(product)" class="px-2 py-1 bg-green-500 text-white font-semibold rounded-full border border-green-500 hover:bg-green-600 hover:text-white">+</button>
        </div>
      </div>
    </div>

    <div class="mt-8">
      <h2 class="text-xl font-semibold mb-4">Информация о доставке</h2>
      <label for="phoneNumber" class="block mb-2">Номер телефона:</label>
      <input v-model="fields.phone" id="phoneNumber" type="text" class="border-gray-300 rounded-md p-2 mb-4 w-full" placeholder="Номер телефона" required>

      <label for="address" class="block mb-2">Адрес доставки:</label>
      <textarea v-model="fields.address" id="address" class="border-gray-300 rounded-md p-2 mb-4 w-full" placeholder="Адрес доставки" required></textarea>

      <label for="email" class="block mb-2">Email:</label>
      <input v-model="fields.email" id="email" type="email" class="border-gray-300 rounded-md p-2 mb-4 w-full" placeholder="Email">

      <p class="text-lg font-semibold">Общая сумма заказа: {{ totalPrice }} ₽</p>
    </div>
    <button @click="makeOrder" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">Заказать</button>
  </div>
  <div v-else>
    <p class="text-lg font-semibold">Корзина пуста</p>
  </div>
</template>

<style scoped>

</style>