<script setup>
import Header from "./components/header/HeaderApp.vue";
import ProductList from "./components/product-list/ProductList.vue";
</script>

<template>
  <Header/>
  <ProductList/>
</template>

<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
