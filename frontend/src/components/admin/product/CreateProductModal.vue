<script setup>
import {computed, onMounted, ref} from "vue";
import {useAdminStore} from "../../../stores/adminStore.js";

const adminStore = useAdminStore();
const error = computed(() => adminStore.errors);
const categories = computed(() => adminStore.categories);
const emits = defineEmits({
  'create': Object,
  'close': null
});

const product = ref({
  name: '',
  description: '',
  category: '',
  image: '',
  price: [
    {
      "size": 'small',
      "price": 0
    }
  ]
})

const createProduct = () => {
  emits('create', product.value)
}

const handleFileChange = (event) => {
  product.value.image = event.target.files[0];
}

const addPrice = () => {
  const sizeName = product.value.price.length === 1 ? 'medium' : 'big';
  product.value.price.push({
    "size": sizeName,
    "price": 0
  })
}

onMounted(() => {
  adminStore.fetchCategories()
})
</script>

<template>
  <div class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50">
    <div class="bg-white p-4 rounded-md shadow-md">
      <h2 class="text-lg font-bold mb-4">Создать продукт</h2>
      <form @submit.prevent="createProduct">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Наименование</label>
          <input v-model="product.name" required id="name" name="name" type="text"
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          <div v-if="error" class="text-red-500 mb-2" v-for="message in error.name">{{ message }}</div>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Описание</label>
          <textarea v-model="product.description" required id="description" name="description"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
          <div v-if="error" class="text-red-500 mb-2" v-for="message in error.description">{{ message }}</div>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="category">Категория</label>
          <select v-model="product.category" required id="category" name="category"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option v-for="category in categories" :key="category.id" :value="category.name">{{ category.name }}</option>
          </select>
          <div v-if="error" class="text-red-500 mb-2" v-for="message in error.category">{{ message }}</div>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Изображение</label>
          <input @change="handleFileChange" required id="image" name="image" type="file"
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          <div v-if="error" class="text-red-500 mb-2" v-for="message in error.image">{{ message }}</div>
        </div>

        <div class="mb-4 flex flex-col">
          <div v-if="error" class="text-red-500 mb-2" v-for="message in error.price">{{ message }}</div>
          <div class="text-gray-700 text-sm font-bold mb-2">Цена для разных размеров</div>
          <div v-for="size in product.price">
            <label class="block text-gray-700 text-sm font-bold mb-2">{{ size.size }}</label>
            <input v-model="size.price" required type="text"
                   class="shadow appearance-none border rounded  py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>
          <div v-if="product.price.length < 3">
            <button @click="addPrice" class="px-4 py-2 bg-blue-500 text-white rounded-md">Добавить цену</button>
          </div>
        </div>
        <div class="flex justify-between">
          <button class="px-4 py-2 bg-blue-500 text-white rounded-md" type="submit">Сохранить</button>
          <button class="px-4 py-2 bg-red-500 text-white rounded-md" @click="emits('close')">Отмена</button>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>

</style>