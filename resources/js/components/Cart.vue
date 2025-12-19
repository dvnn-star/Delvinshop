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
import { computed, ref } from 'vue';
import { route } from 'ziggy-js';
import { useForm } from '@inertiajs/vue3';


const totalHarga = computed(() => {
    return store.isiProduk.reduce((acc, produk) => {
        return acc + produk.qty * produk.price
    }, 0)
});

const form = useForm({
    items: store.isiProduk,
    total: totalHarga.value,
})
function checkout() {
    form.post(route('order'))
}
const payload = {
    items: store.isiProduk,
    total: totalHarga.value,
}


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
                        <img :src="produk.image" alt="" width="80px" height="80px">
                        <h1 class="text-xl capitalize">{{ produk.nama }}</h1>
                        <h1 class="absolute bottom-0 right-16 text-md">{{ produk.price }}$</h1>
                    </div>
                    <div class="gap-5 align-bottom">
                        <span>{{ produk.qty }}</span>
                        <button class="text-2xl mx-10" @click.stop="produk.qty++">+</button>
                        <button class="text-2xl mr-8" @click.stop="produk.qty = Math.max(1, produk.qty - 1)">-</button>

                    </div>
                    <div class="ml-10">
                        <span class="text-sm">{{ produk.qty * produk.price }}$</span>
                    </div>

                </DropdownMenuItem>

            </div>
            <DropdownMenuItem v-if="store.isiProduk.length > 0">
                <div class="justify-around w-full flex">
                    <button class="bg-blue-600 p-2" @click="checkout">Buy Now</button>
                    <p class="text-base">Total: {{ totalHarga }}</p>
                </div>

            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>