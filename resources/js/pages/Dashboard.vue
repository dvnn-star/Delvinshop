<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ShoppingCart, Wallet, Clock, ArrowUpRight } from 'lucide-vue-next';
import { computed } from 'vue';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
interface Props {
    data: any
}

const props = defineProps<Props>();


const formatPrice = (price: number) => {

    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(price);
};
console.log(props.data)
const TotalHarga = (price: number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(price);
}

const totalPendapatan = computed(() => {
    return props.data.reduce((acc,i) => acc + Number(i.gross_amount),0)
})
const BelumKonfirmasiOrder = computed(() =>{
    return props.data.filter(i => i.status == 'pending').length
})

console.log(BelumKonfirmasiOrder)
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 overflow-hidden">

            <div class="grid gap-4 md:grid-cols-3">
                <div class="p-6 bg-white dark:bg-neutral-900 border border-sidebar-border/70 rounded-xl shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Total Pesanan</p>
                            <h3 class="text-2xl font-bold mt-1">{{ props.data.length }}</h3>
                        </div>
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg text-blue-600">
                            <ShoppingCart class="w-5 h-5" />
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-green-600">
                    </div>
                </div>

                <div class="p-6 bg-white dark:bg-neutral-900 border border-sidebar-border/70 rounded-xl shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Total Pendapatan</p>
                            <h3 class="text-2xl font-bold mt-1">{{ formatPrice(totalPendapatan) }}</h3>
                        </div>
                        <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg text-green-600">
                            <Wallet class="w-5 h-5" />
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-green-600">
                        <ArrowUpRight class="w-3 h-3 mr-1" />
                        <span>8% dari bulan lalu</span>
                    </div>
                </div>

                <div class="p-6 bg-white dark:bg-neutral-900 border border-sidebar-border/70 rounded-xl shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-muted-foreground">Menunggu Konfirmasi</p>
                            <h3 class="text-2xl font-bold mt-1">{{ (BelumKonfirmasiOrder)}}</h3>
                        </div>
                        <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg text-orange-600">
                            <Clock class="w-5 h-5" />
                        </div>
                    </div>
                    <div class="mt-4 text-xs text-muted-foreground">
                        Perlu segera diproses
                    </div>
                </div>
            </div>

            <div
                class="flex-1 bg-white dark:bg-neutral-900 border border-sidebar-border/70 rounded-xl shadow-sm overflow-hidden flex flex-col">
                <div class="p-5 border-b border-sidebar-border/70 flex justify-between items-center">
                    <h3 class="font-bold text-lg">Pesanan Terbaru</h3>
                    <button class="text-sm font-semibold text-blue-600 hover:underline">Lihat Semua</button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-muted/50 text-muted-foreground text-xs uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4 font-semibold">ID Order</th>
                                <th class="px-6 py-4 font-semibold">Pembeli</th>
                                <th class="px-6 py-4 font-semibold">Produk</th>
                                <th class="px-6 py-4 font-semibold">Total</th>
                                <th class="px-6 py-4 font-semibold text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-sidebar-border/70">
                            <tr v-for="i in props.data" :key="i" class="hover:bg-muted/30 transition-colors">
                                <td class="px-6 py-4 text-sm font-mono text-blue-600 italic">#{{ i.id }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="font-medium text-foreground">{{ i.user.name }}</div>
                                    <div class="text-xs text-muted-foreground">{{ i.user.email }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm capitalize">{{i.order_details.map(detail =>
                                    detail.product?.nama).join(',')}}</td>
                                <td class="px-6 py-4 text-sm font-bold">{{TotalHarga(i.gross_amount) }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex px-2 py-1 rounded-full text-[10px] font-bold bg-green-100 text-green-700 border border-green-200 uppercase">
                                        {{ i.status }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </AppLayout>
</template>