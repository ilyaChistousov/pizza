<script setup>
import {useAdminStore} from "../../stores/adminStore.js";
import {computed, onMounted} from "vue";

const adminStore = useAdminStore();
const users = computed(() => adminStore.users);

const deleteUser = (id) => {

}
onMounted(() => {
  adminStore.fetchUsers()
})
</script>

<template>
  <div class="bg-white p-4 rounded-md shadow-md">
    <h2 class="text-lg font-semibold mb-4">Список Пользователей</h2>
    <div v-if="users">
      <div v-for="users in users" :key="users.id" class="flex justify-between items-center mb-2">
          <div>
            <label class="font-semibold">Имя</label>
            <p>{{ users.name }}</p>
          </div>
          <div>
            <label class="font-semibold">Почта</label>
            <p>{{ users.email }}</p>
          </div>
          <div>
            <label class="font-semibold">Телефон</label>
            <p>{{ users.phone }}</p>
          </div>
          <div>
            <label class="font-semibold">Роль</label>
            <p>{{ users.role }}</p>
          </div>
          <div>
            <label class="font-semibold">Дата регистрации</label>
            <p>{{ users.created_at }}</p>
          </div>
        <div class="flex flex-col gap-3">
          <button @click="deleteUser(product.id)" class="px-2 py-1 bg-red-500 text-white rounded-md">Удалить</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>