<script setup lang="ts">


interface Order {
    id: number,
    gross_amount: number,
    invoice_number: String,
}
interface Props {
    Order: Order

}
const props = defineProps<Props>();
console.log(props.Order)
</script>

<template>
    <h1>halo bang</h1>
 <div v-if="props.Order">
        
        <div class="card border">
            <p class="text-black">ID: {{ props.Order.id }}</p>
            <p class="text-black">Invoice: {{ props.Order.invoice_number }}</p>
            <p class="text-black">Total: {{ props.Order.gross_amount }}</p>
            <p class="text-black">Status: {{ props.Order.status }}</p>
        </div>
        
    </div>
</template>