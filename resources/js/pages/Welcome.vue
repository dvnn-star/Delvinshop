<script setup lang="ts">
import { dashboard, login, register, gproducts } from '@/routes';
import { Head, Link, usePage } from '@inertiajs/vue3';
import type { AppPageProps } from '@/types';
import RatingSection from '@/components/RatingSection.vue';
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

interface Ratings{
  id:number;
  user : string;
  Ratings:string;
  Bintang:number;
}

interface Props {
  products: PaginatedProducts;
  results: Product[];
  ratings: Ratings[];
}

const page = usePage<AppPageProps>();
const props = defineProps<Props>();


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
  <div class="flex items-center justify-between p-6 lg:p-8 bg-[#fffffe] text-[#1b1b18]">
    <!-- Kiri: Nama toko -->
    <div>
      <a href="/">
        <p class="text-2xl font-bold text-[#1b1b18]">Delvin's Shop</p>
      </a>
    </div>

    <!-- Kanan: Navigasi -->
    <header class="w-full max-w-[335px] lg:max-w-4xl text-sm">
      <nav class="flex justify-end gap-4">
        <Link v-if="page.props.auth.user" :href="dashboard()" class="inline-block rounded-sm border px-5 py-1.5 text-sm leading-normal 
                 border-[#19140035] text-[#ffffff] bg-slate-800 hover:border-[#1915014a]">
        Dashboard
        </Link>

        <template v-else>
          <Link v-if="page.props.auth.user" :href="gproducts()" class="inline-block rounded-sm border px-5 py-1.5 text-sm leading-normal 
                   border-[#020201e3] text-[#ffffff] bg-slate-800 hover:border-[#1915014a]">
          View Products
          </Link>

          <Link :href="login()" class="inline-block rounded-sm px-5 py-1.5 text-sm leading-normal 
                   text-[#ffffff] bg-slate-800 hover:border-[#19140035]">
          Log in
          </Link>

          <Link :href="register()" class="inline-block rounded-sm border px-5 py-1.5 text-sm leading-normal 
                   border-[#19140035] text-[#ffffff] bg-slate-800 hover:border-[#1915014a]">
          Register
          </Link>
        </template>
      </nav>
    </header>
  </div>

  <section class="bg-white ">
    <div
      class="flex mt-10 rounded-4xl border  mx-auto text-center bg-white bg-[url('img/kirby.jpeg')] h-40 bg-cover max-w-6xl bg-no-repeat">
      <div class="text-center font-bold text-2xl mx-auto my-8">
        <h1 class="text-black font-bold text-3xl">Welcome to Delvin Shop</h1>
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
    <p class='text-black absolute   left-20 -top-10 text-2xl  font-bold'>List:</p>
    <div
      class="card bg-base-100 w-80 shadow-sm"
      v-for="product in props.products.data"
      :key="product.id"
    >
      <figure>
        <img :src="product.image" alt="Product image" class="object-cover h-48 w-full" />
      </figure>
      <div class="card-body">
        <h2 class="card-title">{{ product.nama }}</h2>
        <p>{{ product.description }}</p>
        <p class="text-xl absolute bottom-7 left-7 font-bold underline">{{ product.price }}$</p>
        <div class="card-actions justify-end">
          <button class="btn btn-primary">Buy Now</button>
        </div>
      </div>
    </div>
  </div>
</section>
<RatingSection :ratings="props.ratings"/>
</template>
