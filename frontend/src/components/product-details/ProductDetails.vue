<script setup>
import {useRoute} from "vue-router";
import {computed, onMounted, ref, watch} from "vue";
import {useProductStore} from "../../stores/ProductStore.js";
import {useCartStore} from "../../stores/cartStore.js";
import router from "../../router/router.js";

const cartStore = useCartStore();
const productStore = useProductStore();
const route = useRoute();
const product = computed(() => productStore.product)
const selectedPrice = ref(0)

onMounted(() => {
  productStore.fetchOneProduct(route.params.id)
})
watch(product, (newProduct) => {
  selectedPrice.value = newProduct.price[0]
})

const addToCart = () => {
  if (product.value) {
    const productData = {
      id: product.value.id,
      name: product.value.name,
      size: selectedPrice.value.size,
      price: selectedPrice.value.price
    }
    cartStore.addProduct(productData)
  }
  router.push('/')
}
</script>

<template>
  <div v-if="product.price">
    <div class="bg-white rounded-xl overflow-hidden flex p-4 h-120 w-120">
      <img class="h-full object-cover rounded-md mr-4" :src="product.image" :alt="product.name">
      <div class="flex flex-col flex-grow">
        <h3 class="text-4xl text-gray-800 mb-2">{{ product.name }}</h3>
        <p class="text-2xl text-gray-600 mb-2">{{ product.description }}</p>
        <div v-if="product.price.length > 1" class="mb-2">
          <label class="text-sm font-medium text-gray-700">Выберите размер:</label>
          <div class="flex items-center mt-1 space-x-4">
            <label v-for="size in product.price" :key="size" class="inline-flex items-center">
              <input type="radio" :value="size" v-model="selectedPrice"
                     class="form-radio text-orange-500 border-gray-300">
              <span class="ml-2 text-sm text-gray-700">{{ size.size }}</span>
            </label>
          </div>
        </div>
        <button @click="addToCart"
                class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-full border border-orange-500 hover:bg-orange-600 hover:text-white">
          Добавить корзину за {{ selectedPrice.price }} ₽
        </button>
      </div>
    </div>
  </div>
</template>