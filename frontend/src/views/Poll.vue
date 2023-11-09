<template>
  <div
    class="w-full mx-auto mt-10 max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
  >
    <form class="space-y-6" action="#" @submit.prevent="vote">
      <h5
        class="text-xl font-medium text-gray-900 dark:text-white text-center mb-5"
      >
        {{ question }}
      </h5>
      <div>
        <div
          v-for="(option, index) in options"
          :key="index"
          class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700 mb-5 "
        >
          <input
            v-model="option_id"
            :id="index"
            type="radio"
            :value="option.id"
            name="bordered-radio"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
          />
          <label
            :for="index"
            class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 "
            >{{ option.option }}</label
          >
        </div>
      </div>
      <div class="flex justify-end">
        <button
          type="submit"
          class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"
        >
          Vote
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Poll",

  data() {
    return {
      loggedIn: localStorage.getItem("loggedIn"),
      token: localStorage.getItem("token"),
      question: "",
      options: [],
      option_id: "",
    };
  },

  mounted() {
    if (!this.loggedIn) {
      return this.$router.push({ name: "login" });
    }
    axios
      .get("http://127.0.0.1:8000/api/poll/" + this.$route.params.id, {
        headers: { Authorization: "Bearer " + this.token },
      })
      .then((res) => {
        this.question = res.data.question;
        this.options = res.data.options;
        console.log(res);
      });
  },

  methods: {
    vote() {
      // const poll_id = parseInt(this.$route.params.id);
      axios
        .post(
          "http://127.0.0.1:8000/api/vote",
          {
            // poll_id: poll_id,
            poll_id: this.$route.params.id,
            option_id: this.option_id,
          },
          {
            headers: { Authorization: "Bearer " + this.token },
          }
        )
        .then(() => {
          this.$router.push({name: "polls"});
        });

    },
  },
};
</script>
