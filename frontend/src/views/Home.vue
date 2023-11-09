<template>
  <div class="mb-10">
    <section
      class="bg-center bg-no-repeat bg-gradient-to-br from-green-400 to-blue-600 bg-blend-multiply"
    >
      <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
        <h1
          class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl"
        >
          Kami Tampung Suara Anda
        </h1>
        <p
          class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48"
        >
          Tunjukkan suara Anda dalam perubahan dengan mengambil bagian dalam
          jajak pendapat kami! Setiap suara memiliki dampak, dan pendapat Anda
          sangat berarti bagi kami. Bergabunglah sekarang dan berikan kontribusi
          untuk merumuskan arah masa depan yang lebih baik.
        </p>
        <div
          class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4"
        >
          <router-link :to="{ name: 'polls' }">
            <a
              href="#"
              class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900"
            >
              Mulai Vote
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
          </router-link>
          
        </div>
      </div>
    </section>
  </div>

  
</template>

<script>
export default {
  name: "Home",
};
</script>
