<script setup lang="ts">
import { Icon } from "@iconify/vue";
import { dashboard, login, register, gproducts } from '@/routes';
import { Head, Link, usePage } from '@inertiajs/vue3';
import type { AppPageProps } from '@/types';
import Input from './ui/input/Input.vue';
const page = usePage<AppPageProps>();
</script>
<template>
  <div class="  flex justify-center border-b ">
    <div
      class="flex items-center justify-between w-full max-w-6xl px-6 py-4 lg:px-8 bg-[#fffffe] text-[#1b1b18] mb-2"
    >
      <div class="w-56">
        <a href="/">
          <p class="text-2xl font-bold text-[#1b1b18]">Online Shop</p>
        </a>
      </div>

      <div class="flex justify-center w-full  relative max-w-md">
        <Input
          placeholder="Cari produk..."
          class="w-full border border-gray-300  px-3 py-2 focus:outline-none focus:ring-2 rounded-full focus:ring-slate-800 placeholder-black"
        />
        <span class="cursor-pointer absolute right-3 bottom-1.5">
            <Icon icon="mdi:search" width="25"/>
        </span>
      </div>

      <header class="w-56 flex justify-end text-sm">
        <nav class="flex items-center gap-3">
          <Link
            v-if="page.props.auth.user"
            :href="dashboard()"
            class="inline-block rounded-md border px-5 py-1.5 text-sm leading-normal 
                   border-[#19140035] text-white bg-slate-800 hover:bg-slate-700 transition"
          >
            Dashboard
          </Link>

          <template v-else>
            <Link
              :href="login()"
              class="inline-block rounded-md px-5 py-1.5 text-sm leading-normal 
                     text-white bg-slate-800 hover:bg-slate-700 transition"
            >
              Log in
            </Link>
          </template>
        </nav>
      </header>
    </div>
  </div>
</template>
