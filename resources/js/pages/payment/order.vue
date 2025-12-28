<script setup lang="ts">
import { CirclePlay } from 'lucide-vue-next';
import { route } from 'ziggy-js';
import { router } from '@inertiajs/vue3';
interface Order {
    Orders: any
}
const Props = defineProps<Order>();
console.log(Props.Orders)
const checkout = (invoice_number: any) => {
    router.visit(route('order', invoice_number))
}
const Buynow = () => {
    router.visit(route('home'))
}
</script>

<template>
    <div class="p-6 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Daftar Pesanan</h1>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden"
                v-if="Props.Orders.length > 0">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="p-4 font-semibold text-gray-600">ID Pesanan</th>
                            <th class="p-4 font-semibold text-gray-600">Tanggal</th>
                            <th class="p-4 font-semibold text-gray-600">Total Harga</th>
                            <th class="p-4 font-semibold text-gray-600">Status</th>
                            <th class="p-4 font-semibold text-gray-600 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="order in Props.Orders" :key="order.id"
                            class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-blue-600">#{{ order.id }}</td>
                            <td class="p-4 text-gray-600"> {{ new Date(order.created_at).toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric',
                            }) }}</td>
                            <td class="p-4 font-bold text-gray-800">{{ order.gross_amount }}</td>
                            <td class="p-4 font-bold text-gray-800 uppercase">{{ order.status }}</td>
                            <td class="p-4 text-center font-bold text-gray-800">
                                <button class="text-black bg-blue-600 hover:bg-blue-400 p-2 rounded-lg cursor-pointer"
                                    @click="checkout(order.invoice_number)">
                                    Checkout
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-else
                class="flex flex-col items-center justify-center py-16 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                <div class="w-16 h-16 bg-white rounded-2xl shadow-inner flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <p class="text-sm font-bold text-gray-600">Belum ada transaksi</p>
                <p class="text-xs text-gray-400 mt-1">Pesanan kamu akan muncul di sini.</p>
                <button @click="Buynow"
                    class="mt-6 text-xs font-black text-blue-600 border-b-2 border-blue-600 pb-0.5 hover:text-blue-800 transition">
                    MULAI BELANJA &rarr;
                </button>
            </div>
        </div>
    </div>
</template>