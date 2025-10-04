<script setup lang="ts">
import { dashboard, login, register, gproducts } from '@/routes';
import { Head, Link, usePage } from '@inertiajs/vue3';
import type { AppPageProps } from '@/types';

const page = usePage<AppPageProps>();
</script>

<template>
  <Head>
    <link rel="preconnect" href="https://rsms.me/" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  </Head>

  <div
    class="flex items-center justify-between p-6 lg:p-8 bg-[#FDFDFC] text-[#1b1b18] dark:bg-[#0a0a0a]"
  >
    <!-- Welcome di kiri -->
    <div>
      <p class="text-2xl font-bold text-[#1b1b18] dark:text-white">
        Delvin Shop
      </p>
    </div>

    <!-- Navbar di kanan -->
    <header class="w-full max-w-[335px] lg:max-w-4xl text-sm">
      <nav class="flex justify-end gap-4">
        <Link
          v-if="page.props.auth.user"
          :href="dashboard()"
          class="inline-block rounded-sm border px-5 py-1.5 text-sm leading-normal 
                 border-[#19140035] text-[#1b1b18] hover:border-[#1915014a] 
                 dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
        >
          Dashboard
        </Link>

        <template v-else>
          <Link
            :href="gproducts()"
            class="inline-block rounded-sm border px-5 py-1.5 text-sm leading-normal 
                   border-[#19140035] text-[#1b1b18] hover:border-[#1915014a] 
                   dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
          >
            View Products
          </Link>

          <Link
            :href="login()"
            class="inline-block rounded-sm px-5 py-1.5 text-sm leading-normal 
                   text-[#1b1b18] hover:border-[#19140035] 
                   dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
          >
            Log in
          </Link>

          <Link
            :href="register()"
            class="inline-block rounded-sm border px-5 py-1.5 text-sm leading-normal 
                   border-[#19140035] text-[#1b1b18] hover:border-[#1915014a] 
                   dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
          >
            Register
          </Link>
        </template>
      </nav>
    </header>
  </div>
 

<section>
    <div class="flex ml-10 mt-30 ">
        <div class="text-center font-bold text-2xl">
            <p>Hallo welcome to Delvin Shop</p>
        </div>
    </div>
</section>
</template>
