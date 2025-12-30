<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { route } from 'ziggy-js';
import { router } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';


interface Order {
    id: number,
    gross_amount: number,
    invoice_number: String,
}
interface Props {
    Order: Order
    snap_token: String
    midtrans_client_key: any

}
const isSnapLoaded = ref(false);
const props = defineProps<Props>();
const Toast = useToast();
onMounted(() => {
    const script = document.createElement('script');
    script.src = "https://app.sandbox.midtrans.com/snap/snap.js";
    script.setAttribute('data-client-key', props.midtrans_client_key);
    script.onload = () => {
        isSnapLoaded.value = true
    }
    document.head.appendChild(script);
});
const Paynow = () => {
    if (!isSnapLoaded.value) return;
    (window as any).snap.pay(props.snap_token, {
        onSuccess: function (result: any) {
            Toast.success('Payment Berhasil', {
                timeout: 300
            })
            router.visit(route('home'))
        },
        // Optional
        onPending: function (result: any) {
        },
        // Optional
        onError: function (result: any) {

        }
    });
};
const formatPrice = (price: number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
    }).format(price);
};
</script>

<template>
    <div v-if="props.Order">
        <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">

                <div
                    class="px-8 py-6 border-b border-gray-100 bg-gray-50/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">
                            Invoice #{{ props.Order.invoice_number }}
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">
                            Dibuat pada: <span class="font-medium text-gray-700">
                                {{ new Date(Order.created_at).toLocaleDateString('id-ID', {
                                    day: '2-digit',
                                    month: 'long',
                                    year: 'numeric',
                                    hour: '2-digit',
                                    minute: '2-digit'
                                }) }}
                            </span>
                        </p>
                    </div>

                    <div
                        class="px-4 py-1.5 rounded-full text-sm font-bold bg-indigo-100 text-indigo-700 border border-indigo-200 shadow-sm">
                        {{ props.Order.payment_status }}
                    </div>
                </div>

                <div class="px-8 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <h3 class="text-xs uppercase tracking-wider text-gray-400 font-bold mb-3">
                                Ditagihkan Kepada
                            </h3>
                            <div class="text-gray-800 space-y-1">
                                <p class="text-lg font-bold text-gray-900">{{ props.Order.user.name }}</p>
                                <p class="text-sm">{{ props.Order.user.email }}</p>
                                <p class="text-sm text-gray-500">{{ props.Order.user.phone ?? '-' }}</p>
                            </div>
                        </div>


                    </div>

                    <div class="border rounded-lg border-gray-200 overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                                <tr>
                                    <th class="px-6 py-4 font-semibold border-b border-gray-200">Produk</th>
                                    <th class="px-6 py-4 font-semibold border-b border-gray-200 text-right">Harga</th>
                                    <th class="px-6 py-4 font-semibold border-b border-gray-200 text-center">Qty</th>
                                    <th class="px-6 py-4 font-semibold border-b border-gray-200 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr v-for="detail in props.Order.order_details" :key="detail.id"
                                    class="hover:bg-gray-50/50 transition duration-150">
                                    <td class="px-6 py-4 text-sm text-gray-800 font-medium">
                                        {{ detail.product.nama }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 text-right">
                                        {{ formatPrice(detail.price) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 text-center">
                                        {{ detail.quantity }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 font-bold text-right">
                                        {{ formatPrice(detail.price * detail.quantity) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                    <div class="flex flex-col items-end">
                        <div class="w-full md:w-1/2 lg:w-1/3 space-y-3">
                            <div class="flex justify-between text-gray-600 text-sm">
                                <span>Subtotal</span>
                                <span class="font-medium">{{ formatPrice(Order.gross_amount )}}</span>
                            </div>
                            <div class="flex justify-between text-gray-600 text-sm">
                                <span>Pajak (0%)</span>
                                <span class="font-medium">Rp 0</span>
                            </div>

                            <div class="border-t border-gray-300 my-2"></div>

                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">Total Bayar</span>
                                <span class="text-2xl font-bold text-indigo-600">{{ formatPrice(Order.gross_amount) }}</span>
                            </div>

                            <button @click="Paynow"
                                class="w-full mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                                Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>