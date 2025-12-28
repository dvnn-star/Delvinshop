<script setup lang="ts">
import { Icon } from "@iconify/vue";
import { dashboard, login, register, gproducts } from '@/routes';
import { Head, Link, usePage } from '@inertiajs/vue3';
import type { AppPageProps } from '@/types';
import Input from './ui/input/Input.vue';
import UserInfo from '@/components/UserInfo.vue';
import { logout } from '@/routes';
import { edit } from '@/routes/profile';
import type { User } from '@/types';
import { router } from '@inertiajs/vue3';
import { ArrowBigRightDash, LogOut, Settings,Package2 } from 'lucide-vue-next';
import { useDebounce } from "@vueuse/core";
import { watch, ref } from "vue";
import { route } from "ziggy-js";
import Cart from "./Cart.vue";

interface Props {
  user: User;
  Products: Product;
  Results: Product[];
}


interface Product {
  id: number,
  image: string,
  nama: string,
  price: number,
  description: string,
}

const handleLogout = () => {
  router.flushAll();
};

const searchQuery = ref('');
const debouceQuery = useDebounce(searchQuery, 600);
const props = defineProps<Props>();
const page = usePage<AppPageProps>();
watch(debouceQuery, (value) => {
  if (!value) {
    return router.get('/', {}, { preserveState: true })
  }
  router.get(route('search', { q: value }), {}, { preserveState: true })
})
</script>
<template>
  <div class="  flex justify-center border-b ">
    <div
      class="flex items-center justify-between w-full max-w-6xl px-6 py-4 lg:px-8 bg-[#fffffe] text-[#1b1b18] mb-2  ">
      <div class="w-56">
        <a href="/">
          <p class="text-2xl font-bold text-[#1b1b18]">Online Shop</p>
        </a>
      </div>

      <div class="flex justify-center w-full  relative max-w-md">
        <Input placeholder="Cari produk..." v-model="searchQuery"
          class="w-full border border-gray-300  px-3 py-2 focus:outline-none focus:ring-2 rounded-full focus:ring-slate-800 placeholder-black" />

        <span class="cursor-pointer absolute right-3 bottom-1.5">
          <Icon icon="mdi:search" width="25" />
        </span>
        <div v-if="props.Results && props.Results.length > 0">
          <h2 class="mt-4 font-semibold">Hasil Pencarian:</h2>
          <ul>
            <li v-for="item in props.Results" :key="item.id">
              {{ item.nama }} - Rp{{ item.price }}
            </li>
          </ul>
        </div>

      </div>
      <Cart />

      <header class="w-56 flex justify-end text-sm">

        <nav class="flex items-center gap-3">


          <Link v-if="page.props.auth.user === null" :href="login()" class="inline-block rounded-md px-5 py-1.5 text-sm leading-normal 
                     text-white bg-slate-800 hover:bg-slate-700 transition">
          Log in
          </Link>
          <details class="dropdown" v-if="page.props.auth.user && page.props.auth.user.role">
            <summary @click="active = !active" :class="active ? 'w-52 p-2 transition' : ''" class="btn m-1">{{
              page.props.auth.user.name }}</summary>
            <ul class="menu dropdown-content bg-gray-400   gap-1 border  rounded-box z-1 w-52 p-2 shadow-sm">
              <li>
                <Link v-if="page.props.auth.user && page.props.auth.user.role === 'staff'" :href="dashboard()"
                  class="flex w-full border bg-transparent text-white">
                <ArrowBigRightDash class="mr-2 h-4 w-4 text-white" />
                Dashboard
                </Link>
              </li>
              <li>
                <Link class="flex w-full border bg-transparent text-white" :href="route('order.view',page.props.auth.user.id)">
                  <Package2 class="mr-2 h-4 w-4"/>
                  Order
                </Link>
              </li>
              <li>
                <Link class="flex w-full border bg-transparent text-white" :href="page.props.auth.user.role === 'staff'
                  ? route('profile.edit')
                  : route('user.settings')" >
                <Settings class=" mr-2 h-4 w-4 text-white" />
                Settings
                </Link>
              </li>

              <li>
                <Link class="flex w-full  border bg-transparent text-white" :href="logout()" @click="handleLogout"
                  as="button" data-test="logout-button">
                <LogOut class="mr-2 h-4 w-4" />
                Log out</Link>
              </li>
            </ul>
          </details>

        </nav>
      </header>
    </div>
  </div>
</template>
