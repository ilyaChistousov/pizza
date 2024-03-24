<script setup>
import {useAdminStore} from "../../../stores/adminStore.js";
import {computed, ref} from "vue";

const props = defineProps({
  product: {
    type: Object,
    required: true
  }
})
const emits = defineEmits({
  'closeUpdate': null,
  'update': Object
})

const editedProduct = ref({ ...props.product });
const adminStore = useAdminStore();
const error = computed(() => adminStore.errors);

const updateProduct = () => {
  // const formData = new FormData();
  // formData.append('name', editedProduct.value.name);
  // formData.append('description', editedProduct.value.description);
  // editedProduct.value.price.forEach((price, index) => {
  //   formData.append(`price[${index}][size]`, price.size);
  //   formData.append(`price[${index}][price]`, price.price);
  // })
  // formData.append('category', editedProduct.value.category);
  //
  // if (typeof editedProduct.value.image === 'object') {
  //   formData.append('image', editedProduct.value.image);
  // }
  // formData.append('_method', 'PUT');
  //
  // adminStore.updateProduct(editedProduct.value.id, formData, () => {
  //   emits('closeUpdate')
  // })
  emits('update', editedProduct.value)
}

const handleFileChange = (event) => {
  editedProduct.value.image = event.target.files[0];
}

</script>

<template>
  <div class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50">
    <div class="bg-white p-4 rounded-md shadow-md">
      <h3 class="text-lg font-semibold mb-4">Редактировать продукт</h3>
      <form @submit.prevent="updateProduct">
        <div class="flex items-center gap-4">
          <div class="flex flex-col items-center">
            <label class="block font-semibold">Изображение:</label>
            <img :src="editedProduct.image" :alt="editedProduct.name" class="w-24 h-24 object-cover">
            <div v-if="error" class="text-red-500 mb-2" v-for="message in error.image">{{ message }}</div>
            <input type="file" @change="handleFileChange">
          </div>
          <div>
            <div class="mb-4">
              <label class="block font-semibold">Название:</label>
              <input v-model="editedProduct.name" type="text" class="border-gray-300 border w-full p-2 rounded-md">
              <div v-if="error" class="text-red-500 mb-2" v-for="message in error.name">{{ message }}</div>
            </div>
            <div class="mb-4">
              <label class="block font-semibold">Описание:</label>
              <textarea v-model="editedProduct.description" class="border-gray-300 border w-full p-2 rounded-md"></textarea>
              <div v-if="error" class="text-red-500 mb-2" v-for="message in error.description">{{ message }}</div>
            </div>
            <div class="mb-4">
              <label class="block font-semibold">Цена:</label>
              <div class="flex gap-2">
                <div v-for="price in editedProduct.price" :key="price.id">
                  <p>Размер: {{ price.size }}</p>
                  <input v-model="price.price" type="text" class="border-gray-300 border w-full p-2 rounded-md">
                </div>
                <div v-if="error" class="text-red-500 mb-2" v-for="message in error.price">{{ message }}</div>
              </div>
            </div>
          </div>
        </div>
        <div class="flex justify-between">
          <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Сохранить</button>
          <button @click="$emit('closeUpdate')" class="px-4 py-2 bg-gray-500 text-white rounded-md ml-2 self-end">Отмена</button>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped>

</style>