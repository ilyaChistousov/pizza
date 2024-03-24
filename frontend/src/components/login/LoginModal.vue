<script setup>
import {computed, ref} from "vue";
import {useRouter} from "vue-router";
import {useUserStore} from "../../stores/userStore.js";

const show = ref(false);
const router = useRouter()
const userStore = useUserStore()
const emit = defineEmits(['closeModal'])
const props = defineProps({
  showModal: {
    type: Boolean,
    default: false
  }
})
const fields = ref({
  'phone': '88005553333',
  'password': '12345678',
})
const login = () => {
  userStore.login(fields.value, () => emit('closeModal'))
};

const openRegisterForm = () => {
  router.push('/register')
  emit('closeModal')
}

const error = computed(() => userStore.error)
</script>

<template>
  <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="bg-white p-8 rounded-xl z-50 max-w-lg relative">
      <button @click="$emit('closeModal')" class="absolute -top-7 -right-5 p-4 h-4 w-4 text-4xl text-white hover:text-gray-200">&times;</button>
      <div>
        <h2 class="text-xl font-semibold mb-4">Вход</h2>
        <form @submit.prevent="login">
          <label for="phone" class="block mb-2">Номер телефона:</label>
          <input v-model="fields.phone" id="phone" type="text" class="border-gray-300 rounded-md p-2 mb-4 w-full" placeholder="Номер телефона" required>
          <div v-if="error" class="text-red-500 mb-2" v-for="message in error.phone">{{ message }}</div>
          <label for="password" class="block mb-2">Пароль:</label>
          <input v-model="fields.password" id="password" type="password" class="border-gray-300 rounded-md p-2 mb-4 w-full" placeholder="Пароль" required>
          <div v-if="error" class="text-red-500 mb-2" v-for="message in error.password">{{ message }}</div>
          <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-full border border-blue-500 hover:bg-blue-600 hover:text-white">Войти</button>
        </form>
      </div>
      <button @click="openRegisterForm" class="mt-4 px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-full border border-gray-200 hover:bg-gray-300 hover:text-gray-900">Регистрация</button>
    </div>
  </div>
</template>

<style scoped>

</style>