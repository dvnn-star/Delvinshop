<script setup lang="ts">
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import { ShoppingCart } from 'lucide-vue-next';
import { store } from '../pages/shoopingcart/store'
import { computed } from 'vue';
const totalHarga = computed(() => {
    return store.isiProduk.reduce((acc,produk)=> {
        return acc + produk[2] * produk[3]
    },0)
});

console.log(store.isiProduk)
</script>
<template>
    <DropdownMenu>
        <DropdownMenuTrigger>
            <ShoppingCart />
        </DropdownMenuTrigger>
        <DropdownMenuContent>
            <div v-for="produk in store.isiProduk" class=" justify-between px-4 py-2">
                <DropdownMenuItem>
                    <div class="flex gap-3 relative w-50">
                        <img :src="produk[0]" alt="" width="80px" height="80px">
                        <h1 class="text-xl capitalize">{{ produk[1] }}</h1>
                        <h1 class="absolute bottom-0 right-16 text-md">{{ produk[2] }}$</h1>
                    </div>
                    <div class="gap-5 align-bottom">
                        <span>{{ produk[3] }}</span>
                        <button class="text-2xl mx-10" @click.stop="produk[3]++">+</button>
                        <button class="text-2xl mr-8" @click.stop="produk[3] = Math.max(1,produk[3]-1)">-</button>
                        
                    </div>
                    <div class="ml-10">
                        <span class="text-sm">{{ produk[2] * produk[3] }}$</span>
                    </div>

                </DropdownMenuItem>
                
            </div>
            <DropdownMenuItem v-if="store.isiProduk.length > 0">
                <div class="justify-around w-full flex">
                    <button class="bg-blue-600 p-2">Buy Now</button>
                    <p class="text-base">Total: {{ totalHarga }}</p>
                </div>
    
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>