<script setup lang="ts">
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog'

import { ShoppingCart } from 'lucide-vue-next';
import { store } from '../pages/shoopingcart/store'
import { computed, ref } from 'vue';
import { route } from 'ziggy-js';
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';


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
    form.items = store.isiProduk
    form.total = totalHarga.value
    form.post(route('order.store'))
}
const formatPrice = (price: number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(price);
};


</script>
<template>
    <Dialog>
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
                            <h1 class="absolute bottom-0 right-11 text-md">{{ formatPrice(produk.price) }}</h1>
                        </div>
                        <div class="gap-5 align-bottom">
                            <span class="mt-10">{{ produk.qty }}</span>
                            <button class="text-2xl mx-10 " @click.stop="produk.qty++">+</button>
                            <button class="text-2xl mr-8" @click.stop="store.decrement(produk)">-</button>

                        </div>
                        <div class="ml-10">
                            <span class="text-sm">{{ formatPrice(produk.qty * produk.price) }}</span>
                        </div>

                    </DropdownMenuItem>

                </div>
                <DropdownMenuItem v-if="store.isiProduk.length > 0">
                    <div class="justify-around w-full flex">

                        <DialogTrigger as-child>
                            <button class="bg-blue-600 p-2">Buy Now</button>
                        </DialogTrigger>
                        <p class="text-base">Total: {{ formatPrice(totalHarga) }}</p>
                    </div>
                    
                </DropdownMenuItem>
            </DropdownMenuContent>
        </DropdownMenu>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Confirm Order</DialogTitle>
                <DialogDescription>
                    Apakah sudah semua adik adik?
                </DialogDescription>
            </DialogHeader>
            <div v-for="produk in store.isiProduk" class="justify-between flex ">
                <h1>{{ produk.nama }}   </h1>
                <h1>X {{ produk.qty }}</h1>
            </div>
            <button class="bg-blue-400 p-1 mt-2 cursor-pointer" @click="checkout">
                Confirm Orders
            </button>
        </DialogContent>
    </Dialog>
</template>