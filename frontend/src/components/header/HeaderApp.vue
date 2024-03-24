<script setup>
import LoginModal from "../login/LoginModal.vue";
import {computed, ref} from "vue";
import {useUserStore} from "../../stores/userStore.js";
import {useRouter} from "vue-router";


const router = useRouter()
const userStore = useUserStore()
const isLoggedIn = computed(() => userStore.isLoggedIn)
const loginModal = ref(false);

const openLoginModal = () => {
  loginModal.value = !loginModal.value
}

const toProfile = () => {
  router.push(`/profile/${localStorage.getItem('userId')}`)
}
</script>

<template>
  <header>
    <div class="flex justify-between mx-auto py-6">
      <div>Pizza</div>
      <div v-if="isLoggedIn">
        <button @click="toProfile" class="border px-4 py-2 rounded-3xl text-gray-500 bg-gray-100 hover:text-gray-700">Профиль</button>
      </div>
      <div v-else>
        <button @click="openLoginModal" class="border px-4 py-2 rounded-3xl text-gray-500 bg-gray-100 hover:text-gray-700">
          Войти
        </button>
      </div>
    </div>
    <LoginModal :showModal="loginModal" @closeModal="openLoginModal" />
  </header>
</template>