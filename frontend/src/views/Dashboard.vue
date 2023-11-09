<template>
  <div class="mt-10 max-w-5xl mx-auto">
    <!-- CreatePoll -->
    <form @submit.prevent="createPoll">
      <Modal
        :size="size"
        v-if="isShowModalCreatePoll"
        @close="closeModalCreatePoll"
      >
        <template #header>
          <div class="flex items-center text-lg">Buat Poll Baru</div>
        </template>
        <template #body>
          <div class="mb-6">
            <label
              for="default-input"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >Masukkan Pertanyaan</label
            >
            <input
              v-model="question"
              type="text"
              id="question"
              required
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
          </div>
        </template>
        <template #footer>
          <div class="flex">
            <button
              @click="closeModalCreatePoll"
              type="button"
              class="me-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
            >
              Batal
            </button>
            <button
              type="submit"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              Buat
            </button>
          </div>
        </template>
      </Modal>
    </form>

    <button
      @click="showModalCreatePoll"
      type="button"
      class="mb-5 text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800"
    >
      Tambah Poll
    </button>

    <div
      v-for="poll in polls"
      :key="item"
      class="relative overflow-x-auto shadow-md sm:rounded-lg mb-5"
    >
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <caption
          class="p-5 text-lg font-semibold text-left text-gray-900 bg-gray-200 dark:text-white dark:bg-gray-800"
        >
          {{
            poll.question
          }}
          <div class="float-right">
            <button
              v-on:click="pollEdit(poll.id)"
              type="button"
              class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"
            >
              Edit
            </button>
          </div>
        </caption>
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">Options</th>
            <th scope="col" class="px-6 py-3">Vote</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="option in poll.options"
            :key="index"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
          >
            <th
              scope="row"
              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-1/2"
            >
              {{ option.option }}
            </th>
            <td class="px-6 py-4">
              <div
                class="text-sm font-medium text-blue-600 dark:text-white text-right"
              >
                {{ option.vote }}
              </div>
              <div
                class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700"
              >
                <div
                  class="bg-blue-600 h-2.5 rounded-full"
                  :style="
                    'width:' + (option.vote / poll.total_vote) * 100 + '%'
                  "
                ></div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Dashboard",
  data() {
    return {
      polls: [],
      loggedIn: localStorage.getItem("loggedIn"),
      token: localStorage.getItem("token"),
      question: "",
    };
  },

  mounted() {
    if (!this.loggedIn) {
      return this.$router.push({ name: "login" });
    }
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

  methods: {
    pollEdit(id) {
      this.$router.push("/poll/" + id + "/edit");
      console.log(id);
    },

    createPoll() {
      axios.post(
        "http://127.0.0.1:8000/api/poll/create",
        {
          question: this.question,
        },
        {
          headers: { Authorization: "Bearer " + this.token },
        }
      )
      .then(() => {
          console.log('success')
          location.reload();
        });
    },
  },
};
</script>

<script setup>
import { Modal } from "flowbite-vue";
import { ref } from "vue";

const isShowModalCreatePoll = ref(false);
function closeModalCreatePoll() {
  isShowModalCreatePoll.value = false;
}
function showModalCreatePoll() {
  isShowModalCreatePoll.value = true;
}
</script>
