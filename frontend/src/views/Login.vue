<template>
  <div>
    <div
      class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700 mx-auto mt-20"
    >
      <form class="space-y-6" action="#" @submit.prevent="login">
        <h5 class="text-xl font-medium text-gray-900 dark:text-white text-center">
          Masuk Untuk Mulai Vote
        </h5>
        <div
          v-if="loginfailed"
          class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
          role="alert"
        >
          <svg
            class="flex-shrink-0 inline w-4 h-4 mr-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 20 20"
          >
            <path
              d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
            />
          </svg>
          <span class="sr-only">Info</span>
          <div>
            <span class="font-medium"> Email atau Password Anda salah</span>
          </div>
        </div>
        
        <div>
          <label
            for="email"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Your email</label
          >
          <input
            v-model="user.email"
            type="email"
            name="email"
            id="email"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
            placeholder="name@company.com"
            
          />
          <div v-if="validation.email" class="text-red-500 text-sm">
            Masukkan Email
          </div>
        </div>
        <div>
          <label
            for="password"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Your password</label
          >
          <input
            v-model="user.password"
            type="password"
            name="password"
            id="password"
            placeholder="••••••••"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
            
          />
          <div v-if="validation.password" class="text-red-500 text-sm">
            Masukkan Password
          </div>
        </div>

        <button
          type="submit"
          class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
          Login to your account
        </button>
        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
          Not registered?
          <a href="#" class="text-blue-700 hover:underline dark:text-blue-500"
            >Create account</a
          >
        </div>
      </form>
    </div>
  </div>
  
</template>

<script>
import axios from "axios";
export default {
  name: "Login",
  data() {
    return {
      loggedIn: localStorage.getItem("loggedIn"),
      token: localStorage.getItem("token"),
      user: [],
      validation: [],
      loginfailed: null,
    };
  },

  methods: {
    login() {
      if (this.user.email && this.user.password) {
        axios
          .get("http://127.0.0.1:8000/sanctum/csrf-cookie")
          .then((response) => {
            console.log(response);

            axios
              .post("http://127.0.0.1:8000/api/login", {
                email: this.user.email,
                password: this.user.password,
              })
              .then((response) => {
                console.log(response);

                if (response.data.success) {
                  localStorage.setItem("loggedIn", true);
                  localStorage.setItem("token", response.data.token);
                  this.loggedIn = true;
                  return this.$router.push({ name: "home" });
                } else {
                  this.loginfailed = true;
                }
              })
              .catch((error) => {
                console.log(error);
              });
          });
      }
      this.validation = [];

      if (!this.user.email) {
        this.validation.email = true;
      }

      if (!this.user.password) {
        this.validation.password = true;
      }
    },
  },

  mounted() {
    if (this.loggedIn) {
        return this.$router.push({ name: 'home' })
    }
  },
  
};
</script>
