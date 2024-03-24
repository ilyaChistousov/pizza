<script setup>
import {useAdminStore} from "../../stores/adminStore.js";
import {computed, onMounted} from "vue";

const adminStore = useAdminStore();
const orders = computed(() => adminStore.orders);

const toggleDetails = (order) => {
  order.showDetails = !order.showDetails
}

const updateStatus = (id, status) => {
  const data = {
    'status': status
  }
  adminStore.changeStatusOrder(id, data)
}

onMounted(() => {
  adminStore.fetchOrders()
})
</script>

<template>
  <h2 class="text-xl font-bold mb-4">Список заказов</h2>

  <ul>
    <li v-for="order in orders" :key="order.id" class="mb-4">
      <div class="flex items-center justify-between bg-white rounded p-4 shadow">
        <div>
          <span class="font-bold">ID:</span> {{ order.id }} - <span class="font-bold">Дата создания:</span> {{ order.createdAt }}
        </div>
        <button @click="toggleDetails(order)" class="bg-blue-500 text-white px-4 py-2 rounded">Дополнительно</button>
      </div>

      <div v-if="order.showDetails" class="bg-gray-200 p-4 mt-2">
        <p><span class="font-bold">Номер телефона:</span> {{ order.phone }}</p>
        <p><span class="font-bold">Адрес:</span> {{ order.address }}</p>
        <p><span class="font-bold">Продукты:</span></p>
        <ul class="list-disc ml-4">
          <li v-for="product in order.products" :key="product.name">
            {{ product.name }} - {{ product.price }} руб. - {{ product.size }} ({{ product.quantity }} шт.)
          </li>
        </ul>
        <p><span class="font-bold">Статус:</span> {{ order.status }}</p>
        <div class="mt-2">
          <button @click="updateStatus(order.id, 'approved')" class="bg-green-500 text-white px-4 py-2 rounded">Завершено</button>
          <button @click="updateStatus(order.id, 'canceled')" class="bg-red-500 text-white px-4 py-2 rounded ml-2">Отменено</button>
        </div>

      </div>
    </li>
  </ul>
<!--  <div class="bg-white p-4 rounded-md shadow-md">-->
<!--    <h2 class="text-lg font-semibold mb-4">Список Заказов</h2>-->
<!--    <div v-if="orders">-->
<!--      <div v-for="order in orders" :key="orders.id" class="flex justify-between items-center gap-10 mb-2">-->
<!--        <div class="flex justify-between w-full">-->
<!--          <label class="font-semibold">-->
<!--            ID:-->
<!--          </label>-->
<!--          <p>{{ order.id }}</p>-->
<!--          <label class="font-semibold">-->
<!--            Статус:-->
<!--          </label>-->
<!--          <p>{{ order.status }}</p>-->
<!--          <label class="font-semibold">-->
<!--            Дата:-->
<!--          </label>-->
<!--          <p>{{ order.createdAt }}</p>-->
<!--        </div>-->
<!--        <div class="flex flex-col gap-3">-->
<!--          <button @click="deleteUser(product.id)" class="px-2 py-1 bg-green-300 text-white rounded-md">Подробнее</button>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
</template>

<style scoped>

</style>