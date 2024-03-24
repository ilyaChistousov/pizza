<script setup>
import {useUserStore} from "../../stores/userStore.js";
import {computed, onMounted} from "vue";
import {useRoute, useRouter} from "vue-router";

const userStore = useUserStore()
const router = useRouter()
const route = useRoute()
const user = computed(() => userStore.user)
const logout = () => {
  userStore.logout(() => router.push('/'))
}

onMounted(() => {
  userStore.fetchUser(route.params.id)
})
</script>

<template>
  <router-link to="/" class="block mt-4 text-blue-500 hover:underline">Назад</router-link>
  <div class="bg-white p-8 rounded-xl max-w-lg">
    <h2 class="text-xl font-semibold mb-4">Профиль Пользователя</h2>

    <div>
      <h3 class="text-lg font-semibold mb-2">Личные данные</h3>
      <p><strong>Имя:</strong> {{ user.name }}</p>
      <p><strong>Email:</strong> {{ user.email }}</p>
      <p><strong>Номер телефона:</strong> {{ user.phone }}</p>
    </div>

    <div class="mt-10">
      <h3 class="text-lg font-semibold mb-2">Последние заказы</h3>

      <div v-if="user.orders">
        <div v-for="order in user.orders" :key="order.id">
          <div v-if="order.status === 'approved'">
            <p><strong>Номер заказа:</strong> {{ order.id }}</p>
            <p><strong>Сумма:</strong> {{ order.total}} ₽</p>
            <p><strong>Дата заказа:</strong> {{ order.created_at }}</p>
          </div>
        </div>
      </div>
      <div v-else>
        <p>Еще не сделано ни одного заказа (</p>
      </div>

      <button @click="logout" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-full
    border border-red-500 hover:bg-red-600 hover:text-white mt-4">Выйти
      </button>
    </div>
  </div>
</template>

<style scoped>

</style>