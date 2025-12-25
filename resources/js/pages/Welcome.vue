  <script setup lang="ts">

  import { Head, Link, router, usePage } from '@inertiajs/vue3';
  import type { AppPageProps } from '@/types';
  import RatingSection from '@/components/RatingSection.vue';
  import Footer from '@/components/footer.vue';
  import Navbar from '@/components/navbar.vue';
  import Forms from '@/components/forms.vue';
  import { store } from "./shoopingcart/store"
  import { useToast } from 'vue-toastification';
  import Pagination from '@/components/ui/pagination/Pagination.vue';
  import PaginationItem from '@/components/ui/pagination/PaginationItem.vue';
  import Button from '@/components/ui/button/Button.vue';
  import { route } from 'ziggy-js';

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


  // Alert Notification
  const Toast = useToast();
  function BuyNow(image: any, nama: any, price: any,id:number) {

    store.increment({ image, nama, price, jumlahproduk, id,qty: 1 });
    Toast.success("data berhasil dimasukkan", {
      timeout: 1000
    })
  };

  function HandlePagination(Links: string) {
    router.visit(Links, {
      preserveScroll: true,
      preserveState: true,
      only: ['products']
    })
  }

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
        <div class="relative mx-4 mt-4 w-[92px] h-[120px] cursor-pointer" @click="router.visit(route('filter.baju'))">
          <div class="border rounded-full mx-auto w-[92px] h-[92px]
              bg-[url('img/baju.jpeg')] bg-contain bg-center bg-no-repeat "></div>
          <p class="font-bold text-xl text-black absolute bottom-0 right-7">
            Baju
          </p>
        </div>

        <!-- Item 2 -->
        <div class="relative mx-4 mt-4 w-[92px] h-[120px]">
          <div @click="router.visit(route('filter.celana'))" 
          class="border rounded-full mx-auto w-[92px] h-[92px]
              bg-[url('img/celana.jpeg')] bg-contain bg-center cursor-pointer bg-no-repeat"></div>
          <p class="font-bold text-xl text-black absolute  bottom-0 right-3">
            Celana
          </p>
        </div>

        <!-- Item 3 -->
        <div class="relative mx-4 mt-4 w-[92px] h-[120px]">
          <div @click="router.visit(route('filter.gaun'))" class="border rounded-full mx-auto w-[92px] h-[92px] cursor-pointer
              bg-[url('img/gaun.jpeg')] bg-contain bg-center bg-no-repeat"></div>
          <p class="font-bold text-xl text-black absolute bottom-0 left-5">
            Gaun
          </p>
        </div>

        <!-- Item 4 -->
        <div class="relative mx-4 mt-4 w-[92px] h-[120px]">
          <div @click="router.visit(route('filter.kemeja'))" class="border rounded-full mx-auto w-[92px] cursor-pointer h-[92px]
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
              <button class="btn btn-primary" @click="BuyNow(product.image, product.nama, product.price,product.id)">Buy
                Now</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="flex justify-center items-center gap-2 my-8">
      <button v-for="(links, i) in props.products.links.pages" :key="i" :disabled="!links.url"
        @click="() => links.url && HandlePagination(links.url)" :class="[
          'px-4 py-2 rounded-lg font-medium transition-all duration-200',
          links.active
            ? 'bg-blue-600 text-white shadow-md'
            : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50',
          !links.url ? 'opacity-50 cursor-not-allowed' : 'hover:scale-105 cursor-pointer'
        ]">
        <span v-html="links.label"></span>
      </button>
    </div>
    <RatingSection :ratings="props.ratings" />
    <Forms />
    <Footer />

  </template>
