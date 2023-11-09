<template>
  <!-- nav -->
  <nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div
      class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4"
    >
      <a href="" class="flex items-center">
        <img
          src="./assets/logo.png"
          class="h-8 mr-3"
          alt="Flowbite Logo"
        />
        <span
          class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"
          >Polling</span
        >
      </a>

      <!-- login logout -->
      <div class="flex md:order-2">
        <router-link :to="{ name: 'login' }" v-if="!loggedIn">
          <button           
            type="button"
            class="text-blue-700 font-medium text-sm px-2 py-2 text-center mr-3 hover:underline"
          >
            Login
          </button>
        </router-link>
        <!-- <button
          v-if="!loggedIn"
          data-modal-target="registerModal"
          data-modal-toggle="registerModal"
          type="button"
          class="text-blue-700 font-medium text-sm px-2 py-2 text-center mr-3 hover:underline"
        >
          Register
        </button> -->
        <button
          v-if="loggedIn"
          @click="logout"
          id="logout"
          type="button"
          class="text-blue-700 font-medium text-sm px-2 py-2 text-center mr-3 hover:underline"
        >
          Logout
        </button>

        <button
          data-collapse-toggle="navbar-cta"
          type="button"
          class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          aria-controls="navbar-cta"
          aria-expanded="false"
        >
          <span class="sr-only">Open main menu</span>
          <svg
            class="w-5 h-5"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 17 14"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M1 1h15M1 7h15M1 13h15"
            />
          </svg>
        </button>
      </div>

      <div
        class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
        id="navbar-cta"
      >
        <ul
          class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"
        >
          <li>
            <router-link :to="{ name: 'home' }">
              <a
                href="#"
                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                :class="{ 'active': $route.name === 'home' }">Home</a
              >
            </router-link>
          </li>
          <li v-if="loggedIn">
            <router-link :to="{ name: 'polls' }">
              <a
                href="#"
                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                :class="{ 'active': $route.name === 'polls' }">Polls</a
              >
            </router-link>
          </li>
          <li v-if="loggedIn">
            <router-link :to="{ name: 'dashboard' }">
              <a
                href="#"
                class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                :class="{ 'active': $route.name === 'dashboard' }">Dashboard</a
              >
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="max-w-screen-xl mx-auto">
    <router-view></router-view>
  </div>




</template>

<style>
.active {
  /* Gaya untuk menandai nav aktif */
  font-weight: bold;
  color: blue;
  /* Tambahkan properti styling lain yang Anda inginkan */
}
</style>

<script>
import axios from "axios";
axios.defaults.withCredentials = true;

export default {
  name: "App",

  data() {
    return {
      loggedIn: null,
      // loggedIn: localStorage.getItem('loggedIn'),

    };
  },

  methods: {
    logout() {
      axios.get("http://127.0.0.1:8000/api/logout").then((response) => {
        localStorage.removeItem("loggedIn");
        this.loggedIn = null;
        this.$router.push({ name: "home" });
      });
    },
    getLoggedIn() {
      this.loggedIn = localStorage.getItem("loggedIn");
    },
  },

  watch: {
    $route: {
      immediate: true,
      handler() {
        this.getLoggedIn();
      },
    },
  },

  mounted() {
    if (!this.loggedIn) {
      return this.$router.push({ name: "home" });
    }
  },
};
</script>
