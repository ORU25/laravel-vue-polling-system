<template>
  <div class="mt-10 max-w-5xl mx-auto overflow-x-auto shadow-md sm:rounded-lg">
    <button
      @click="showModal"
      type="button"
      class="mb-5 px-3 py-2 text-lg font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
    >
      Hapus
    </button>
    <form @submit.prevent="pollDelete">
      <Modal :size="size" v-if="isShowModal" @close="closeModal">
        <template #header>
          <div class="flex items-center text-lg"></div>
        </template>
        <template #body>
          <div class="p-4 text-center">
            <svg
              class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 20 20"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
              />
            </svg>
            <h3
              class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
            >
              Apakah Kamu Yakin Untuk Menghapusnya ?
            </h3>
          </div>
        </template>
        <template #footer>
          <div class="flex justify-center">
            <button
              type="submit"
              class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
            >
              Yes, Delete
            </button>
            <button
              @click="closeModal"
              type="button"
              class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
            >
              No, Cancel
            </button>
          </div>
        </template>
      </Modal>
    </form>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <caption
        class="p-5 text-lg font-semibold text-left text-gray-900 bg-gray-200 dark:text-white dark:bg-gray-800"
      >
        <div class="flex">
          <div class="me-5">
            {{ poll.question }}
          </div>

          <div class="flex">
            <form class="flex" @submit.prevent="pollEdit">
              <input
                v-model="question"
                type="text"
                id="question"
                class="me-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Edit Pertanyaan"
                required
              />
              <button
                type="submit"
                class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                Simpan
              </button>
            </form>
          </div>
        </div>
      </caption>

      <thead
        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
      >
        <tr>
          <th scope="col" class="px-6 py-3">Options</th>
          <th scope="col" class="px-6 py-3">Aksi</th>
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
          <td class="px-6 py-4 flex">
            <form class="flex me-5" @submit.prevent="optionEdit(option.id)">
              <input
                v-model="options[option.id]"
                type="text"
                :id="'option' + option.id"
                class="me-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Edit Option"
                required
              />
              <button
                type="submit"
                class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              >
                Simpan
              </button>
            </form>
            <button
              @click="showModalOption"
              type="submit"
              class="px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
            >
              Hapus
            </button>
          <form @submit.prevent="optionDelete(option.id)">
            <Modal
              :size="size"
              v-if="isShowModalOption"
              @close="closeModalOption"
            >
              <template #header>
                <div class="flex items-center text-lg"></div>
              </template>
              <template #body>
                <div class="p-4 text-center">
                  <svg
                    class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 20 20"
                  >
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                    />
                  </svg>
                  <h3
                    class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
                  >
                    Apakah Kamu Yakin Untuk Menghapusnya ?
                  </h3>
                </div>
              </template>
              <template #footer>
                <div class="flex justify-center">
                  <button
                    type="submit"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                  >
                    Yes, Delete
                  </button>
                  <button
                    @click="closeModalOption"
                    type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                  >
                    No, Cancel
                  </button>
                </div>
              </template>
            </Modal>
          </form>
          </td>
        </tr>
        <tr>
          <td></td>
          <td class="px-6 py-4">
            <form class="flex me-5" @submit.prevent="createOption">
              <input
                v-model="newOption"
                type="text"
                id="createoption"
                class="me-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Tambah Option Baru"
                required
              />
              <button
                type="submit"
                class="px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
              >
                Simpan
              </button>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      loggedIn: localStorage.getItem("loggedIn"),
      token: localStorage.getItem("token"),
      poll: [],
      question: "",
      options: {},
      newOption: "",
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
        this.poll = res.data;
        console.log(res);
      });
  },

  methods: {
    pollEdit() {
      axios
        .post(
          "http://127.0.0.1:8000/api/poll/" + this.$route.params.id + "/edit",
          {
            question: this.question,
          },
          {
            headers: { Authorization: "Bearer " + this.token },
          }
        )
        .then(() => {
          location.reload();
        });
    },

    optionEdit(optionId) {
      axios
        .post(
          "http://127.0.0.1:8000/api/poll/option/" + optionId + "/edit",
          {
            option: this.options[optionId],
          },
          {
            headers: { Authorization: "Bearer " + this.token },
          }
        )
        .then(() => {
          location.reload();
        });
    },

    createOption() {
      axios
        .post(
          "http://127.0.0.1:8000/api/poll/" +
            this.$route.params.id +
            "/createOption",
          {
            option: this.newOption,
          },
          {
            headers: { Authorization: "Bearer " + this.token },
          }
        )
        .then(() => {
          console.log("success");
          location.reload();
        });
    },

    pollDelete() {
      axios
        .delete("http://127.0.0.1:8000/api/poll/" + this.$route.params.id, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then(() => {
          console.log("success");
          return this.$router.push({ name: "dashboard" });
        });
    },

    optionDelete(option_id) {
      axios
        .delete("http://127.0.0.1:8000/api/poll/option/" + option_id, {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then(() => {
          console.log("success");
          location.reload();
        });
    },
  },
};
</script>
<script setup>
import { Modal } from "flowbite-vue";
import { ref } from "vue";

const isShowModal = ref(false);
function closeModal() {
  isShowModal.value = false;
}
function showModal() {
  isShowModal.value = true;
}


const isShowModalOption = ref(false);
function closeModalOption() {
  isShowModalOption.value = false; 
}
function showModalOption() {
  isShowModalOption.value = true;
}
</script>
