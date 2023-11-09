<template>
  <div class="mt-10 max-w-5xl mx-auto">
    <div class="flex flex-wrap">
      <div
        v-for="poll in polls"
        :key="poll.id"
        class="my-2 mx-2 max-w-sm p-6 bg-gradient-to-br from-green-400 to-blue-600 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
      >
        <a href="#">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">
            {{ poll.question }}
          </h5>
        </a>

        <div class="mb-5">
          <div v-for="option in poll.options" :key="option.id">
            <div class="flex justify-between mb-1">
              <span class="text-base font-medium text-white dark:text-white">{{
                option.option
              }}</span>
              <span class="text-sm font-medium text-white dark:text-white">{{
                option.vote
              }}</span>
            </div>
            <div class="w-full bg-gray-400 rounded-full h-2.5 dark:bg-gray-700">
              <div
                class="bg-gray-100 h-2.5 rounded-full"
                :style="'width:' + (option.vote / poll.total_vote) * 100 + '%'"
              ></div>
            </div>
          </div>
        </div>

        <a
          v-on:click="polling(poll.id)"
          href="#"
          class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
          Ikut Vote
          <svg
            class="w-3.5 h-3.5 ml-2"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 14 10"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M1 5h12m0 0L9 1m4 4L9 9"
            />
          </svg>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Polls",
  data() {
    return {
      polls: [],
      loggedIn: localStorage.getItem("loggedIn"),
      token: localStorage.getItem("token"),
    };
  },
  created() {
    axios
      .get("http://127.0.0.1:8000/api/polls", {
        headers: { Authorization: "Bearer " + this.token },
      })
      .then((r) => {
        this.polls = r.data;
      });
  },

  mounted() {
    if (!this.loggedIn) {
      return this.$router.push({ name: "login" });
    }
  },

  methods: {
    polling(poll_id) {
      this.$router.push("/poll/" + poll_id);
      console.log(poll_id);
    },
  },
};
</script>
