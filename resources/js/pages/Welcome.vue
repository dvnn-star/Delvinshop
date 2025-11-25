<script setup lang="ts">

import { Head, Link, usePage } from '@inertiajs/vue3';
import type { AppPageProps } from '@/types';
import RatingSection from '@/components/RatingSection.vue';
import Footer from '@/components/footer.vue';
import Navbar from '@/components/navbar.vue';
import Forms from '@/components/forms.vue';
import { store } from "./shoopingcart/store"

interface Product {
  id: number;
  image: string;
  nama: string;
  price: number;
  description: string;
}

interface PaginationLinks {
  first: string | null;
  last: string | null;
  prev: string | null;
  next: string | null;
}

interface PaginationMeta {
  current_page: number;
  last_page: number;
  total: number;
}

interface PaginatedProducts {
  data: Product[];
  meta: PaginationMeta;
  links: PaginationLinks;
}

interface Ratings {
  id: number;
  user: string;
  Ratings: string;
  Bintang: number;
}

interface Props {
  products: PaginatedProducts;

  ratings: Ratings[];

}
let jumlahproduk = 1
const page = usePage<AppPageProps>();
const props = defineProps<Props>();

console.log(store.isiProduk)
console.log(props.ratings)
</script>

<style>
body {
  background-color: #fffffe;
}
</style>
<template>

  <Head>
    <link rel="preconnect" href="https://rsms.me/" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  </Head>

  <!-- Header utama -->
  <Navbar />

  <section class="bg-white ">
    <div
      class="flex mt-10 rounded-4xl border  mx-auto text-center bg-white bg-[url('img/kirby.jpeg')] h-40 bg-cover max-w-6xl bg-no-repeat">
      <div class="text-center font-bold text-2xl mx-auto my-8">
        <h1 class="text-black font-bold text-3xl">Welcome to Online Shop</h1>
        <p class="mt-4 text-lg text-black font-semibold ">
          Your one-stop shop for all your needs!
        </p>
      </div>
    </div>
  </section>
  <section>
    <div class="w-full  mx-auto flex justify-center  h-[200px]">
      <div class="relative mx-4 mt-4 w-[92px] h-[120px]">
        <div class="border rounded-full mx-auto w-[92px] h-[92px]
             bg-[url('img/baju.jpeg')] bg-contain bg-center bg-no-repeat "></div>
        <p class="font-bold text-xl text-black absolute bottom-0 right-7">
          Baju
        </p>
      </div>

      <!-- Item 2 -->
      <div class="relative mx-4 mt-4 w-[92px] h-[120px]">
        <div class="border rounded-full mx-auto w-[92px] h-[92px]
             bg-[url('img/celana.jpeg')] bg-contain bg-center bg-no-repeat"></div>
        <p class="font-bold text-xl text-black absolute bottom-0 right-3">
          Celana
        </p>
      </div>

      <!-- Item 3 -->
      <div class="relative mx-4 mt-4 w-[92px] h-[120px]">
        <div class="border rounded-full mx-auto w-[92px] h-[92px]
             bg-[url('img/gaun.jpeg')] bg-contain bg-center bg-no-repeat"></div>
        <p class="font-bold text-xl text-black absolute bottom-0 left-5">
          Gaun
        </p>
      </div>

      <!-- Item 4 -->
      <div class="relative mx-4 mt-4 w-[92px] h-[120px]">
        <div class="border rounded-full mx-auto w-[92px] h-[92px]
             bg-[url('img/kemeja.jpeg')] bg-contain bg-center bg-no-repeat"></div>
        <p class="font-bold text-xl text-black absolute bottom-0 left-3">
          Kemeja
        </p>
      </div>
    </div>

  </section>

  <section class="py-8">
    <div class="flex justify-center relative gap-6 flex-wrap max-w-6xl mx-auto">
      <p class='text-black absolute   left-20 -top-10 text-2xl  font-bold'>Product:</p>
      <div class="card bg-base-100 w-80 shadow-sm" v-for="product in props.products.data" :key="product.id">
        <figure>
          <img :src="product.image" alt="Product image" class="object-cover h-48 w-full" />
        </figure>
        <div class="card-body">
          <h2 class="card-title">{{ product.nama }}</h2>
          <p>{{ product.description }}</p>
          <p class="text-xl absolute bottom-7 left-7 font-bold underline">{{ product.price }}$</p>
          <div class="card-actions justify-end mt-3">
            <button class="btn btn-primary" @click="store.increment([product.image,product.nama, product.price,jumlahproduk])">Buy Now</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <RatingSection :ratings="props.ratings" />
  <Forms />
  <Footer />

</template>
