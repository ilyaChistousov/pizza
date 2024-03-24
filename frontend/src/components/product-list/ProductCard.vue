<script setup>
import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";
const route = useRoute();
const router =useRouter()
const props = defineProps({
  product: {
    type: Object,
    required: true,
    default: () => {
    },
  }
})

const isHovering = ref(false);

const openDetails = () => router.push({
  name: 'product',
  params: {
    id: props.product.id
  }
})

</script>

<template>
  <div @click="openDetails"
       @mouseenter="isHovering = true"
       @mouseleave="isHovering = false"
       :class="{'cursor-pointer': isHovering}"
       class="bg-white rounded-xl overflow-hidden flex flex-col items-center">
    <img class="h-full w-full aspect-square transition-transform duration-300"
         :class="{'hover:translate-y-3': isHovering}"
         :src="product.image"
         :alt="product.name">
    <div class="p-4 flex flex-col items-start w-full">
      <h3 class="text-lg font-semibold text-gray-800 h-8 overflow-hidden">{{ product.name }}</h3>
      <p class="mt-2 text-sm text-gray-600 h-16 overflow-hidden">{{ product.description }}</p>
      <div class="flex justify-between items-center mt-4 w-full">
        <span class="text-gray-700 font-semibold">{{ product.price }} ₽</span>
        <button class="px-4 py-2 bg-orange-500 text-white font-semibold
        rounded-full border border-orange-500 hover:bg-orange-600 hover:text-white">В корзину
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>