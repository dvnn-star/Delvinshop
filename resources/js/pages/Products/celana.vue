<script setup lang="ts">
import Navbar from '@/components/navbar.vue';
// Menambahkan Head dari Inertia untuk title browser
import { Head } from '@inertiajs/vue3';
import { store } from '../shoopingcart/store';
import { useToast } from 'vue-toastification';

interface Product {
  id: number
  image: string
  nama: string
  description: string
  price: string
}

interface Props {
  datas: Product[];
}
let jumlahproduk =1
const props = defineProps<Props>();
const Toast = useToast()

// Placeholder function agar tidak error saat tombol diklik
const BuyNow = (image: string, nama: string, price: string) => {

  store.increment({ image, nama, price, jumlahproduk, qty: 1 });
  Toast.success("data berhasil dimasukkan", {
    timeout: 1000
  })
};
</script>

<template>

  <Head title="Koleksi Baju" />
  <Navbar />

  <main class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto">
      <div class="mb-10 flex items-center justify-between border-b border-gray-200 pb-5">
        <div>
          <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Koleksi Celana</h1>
          <p class="mt-2 text-sm text-gray-500">Menampilkan {{ props.datas.length }} produk terbaik untuk Anda.</p>
        </div>
      </div>

      <div v-if="props.datas.length > 0"
        class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
        <div v-for="product in props.datas" :key="product.id"
          class="group relative bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col border border-gray-100">
          <div
            class="aspect-h-1 aspect-w-1 w-full overflow-hidden bg-gray-200 group-hover:opacity-90 transition-opacity">
            <img :src="product.image" :alt="product.nama"
              class="h-64 w-full object-cover object-center transform group-hover:scale-105 transition-transform duration-500" />
            <div class="absolute top-4 left-4">
              <span class="bg-black text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-widest">New
                Arrival</span>
            </div>
          </div>

          <div class="p-6 flex flex-col flex-grow">
            <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight">
              {{ product.nama }}
            </h3>
            <p class="text-sm text-gray-500 line-clamp-2 mb-4 flex-grow">
              {{ product.description }}
            </p>

            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
              <div>
                <span class="text-xs text-gray-400 block uppercase font-semibold">Harga</span>
                <p class="text-xl font-black text-indigo-600">${{ product.price }}</p>
              </div>

              <button @click="BuyNow(product.image, product.nama, product.price)"
                class="bg-black hover:bg-indigo-700 text-white p-3 rounded-xl transition-colors duration-200 group/btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover/btn:scale-110 transition-transform"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div v-else class="text-center py-20">
        <div class="text-6xl mb-4">📦</div>
        <h3 class="text-lg font-medium text-gray-900">Belum ada produk</h3>
        <p class="text-gray-500">Cek kembali nanti untuk koleksi terbaru kami.</p>
      </div>
    </div>
  </main>
</template>

