<script setup>
import {useProductStore} from "../../stores/ProductStore.js";
import {computed, onBeforeUnmount, onMounted, ref} from "vue";
import ProductCard from "./ProductCard.vue";
import {useRouter} from "vue-router";

const router = useRouter()
const productStore = useProductStore();
const groupedProducts = computed(() => productStore.getProducts)

onMounted(() => {
  productStore.fetchProducts()
  window.addEventListener('scroll', handleScroll);
})

onBeforeUnmount(() => {
  window.removeEventListener('scroll', handleScroll);
})

const isSticky = ref(false);
const categoryRefs = ref([]);
const handleScroll = () => {
  isSticky.value = window.scrollY > 0;
}

function scrollToCategory(index) {
  const categoryRef = categoryRefs.value[index];
  if (categoryRef) {
    const y = categoryRef.getBoundingClientRect().top + window.scrollY - 73;
    window.scrollTo({top: y, behavior: 'smooth'});
  }
}
const toCart = () => {
  router.push('cart')
}

</script>

<template>
  <div class="flex flex-col">
    <div :class="{'sticky top-0': isSticky}"
         class="flex justify-between px-4 py-4 z-40 backdrop-blur-lg items-center ">
      <div class="flex bg-transparent gap-3 text-center">
        <div v-for="(category, index) in groupedProducts" :key="index">
          <button @click="scrollToCategory(index)" class="text-gray-800 hover:text-orange-500 font-semibold">{{
              category.name
            }}
          </button>
        </div>
      </div>
      <button @click="toCart" class="mt-auto px-4 py-2 bg-orange-500 text-white font-semibold rounded-full
          hover:bg-orange-600 hover:text-white">
        Корзина
      </button>
    </div>
    <div class="flex-grow">
      <div v-for="(category, index) in groupedProducts" :key="index">
        <h2 ref="categoryRefs" :id="index" class="text-4xl font-semibold text-gray-800 my-16">{{ category.name }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-16">
          <ProductCard v-for="product in category.products" :key="product.id" :product="product"/>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
</style>