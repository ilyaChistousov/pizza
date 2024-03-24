<script setup>
import {useAdminStore} from "../../stores/adminStore.js";
import {computed, onMounted, ref} from "vue";
import UpdateProductModal from "./product/UpdateProductModal.vue";
import CreateProductModal from "./product/CreateProductModal.vue";

const adminStore = useAdminStore();
const products = computed(() => adminStore.products);
const errors = computed(() => adminStore.errors);

const selectedProduct = ref(null);
const openCreateModal = ref(false)

const deleteProduct = (id) => {
  adminStore.deleteProduct(id)
}

const openUpdateModal = (product) => {
  selectedProduct.value = product
}

const updateProduct = (product) => {
  const formData = createFormData(product)
  if (product.id) {
    formData.append('_method', 'PUT');
    adminStore.updateProduct(product.id, formData, () => {
      selectedProduct.value = null
    })
  } else {
    adminStore.createProduct(formData, () => {
      openCreateModal.value = false
    })
  }
}

const createFormData = (product) => {
  const formData = new FormData();
  formData.append('name', product.name);
  formData.append('description', product.description);
  product.price.forEach((price, index) => {
    formData.append(`price[${index}][size]`, price.size);
    formData.append(`price[${index}][price]`, price.price);
  })
  formData.append('category', product.category);

  if (typeof product.image === 'object') {
    formData.append('image', product.image);
  }
  return formData
}

onMounted(() => {
  adminStore.fetchProducts()
})
</script>

<template>
  <div class="bg-white p-4 rounded-md shadow-md">
    <button @click="openCreateModal = true" class="px-4 py-2 bg-blue-500 text-white rounded-md">Добавить продукт</button>
    <h2 class="text-lg font-semibold mb-4">Список Продуктов</h2>
    <div v-if="products">
      <div v-for="product in products" :key="product.id" class="flex justify-between items-center mb-2">
        <div class="flex items-center">
          <img :src="product.image" :alt="product.name" class="w-24 h-24 object-cover">
          <div>
            <p class="font-semibold">{{ product.name }}</p>
            <p>{{ product.description }}</p>
            <p v-for="price in product.price" :key="price.id">Размер: {{ price.size }} - Цена: {{ price.price }} ₽</p>
          </div>
        </div>
        <div class="flex flex-col gap-3">
          <button @click="deleteProduct(product.id)" class="px-2 py-1 bg-red-500 text-white rounded-md">Удалить</button>
          <button @click="openUpdateModal(product)" class="px-2 py-1 bg-blue-500 text-white rounded-md">Обновить</button>
        </div>
      </div>
    </div>
    <p v-else class="text-gray-500">Нет продуктов для отображения</p>
    <div v-if="selectedProduct">
      <UpdateProductModal :product="selectedProduct" @update="updateProduct" @closeUpdate="selectedProduct.value = null"/>
    </div>
    <div v-if="openCreateModal">
      <CreateProductModal @close="openCreateModal = false" @create="updateProduct"/>
    </div>
  </div>
</template>

<style scoped>

</style>