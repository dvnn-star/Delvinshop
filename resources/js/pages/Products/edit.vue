<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { route } from 'ziggy-js';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit A Product',
        href: '',
    }
]


const Handlesubmit = () => {
    forms.post(route('products.update',{product:props.product}))

}



interface Product {
    id: number,
    nama: string,
    price: number,
    description: string,
};

const props= defineProps<{product : Product}>();


const forms = useForm({
    nama: props.product.nama,
    price: props.product.price,
    description: props.product.description
});

</script>

<template>

    <Head title="products" />

    <AppLayout :breadcrumbs="breadcrumbs">
   
        <div class="p-4 ">
            <form @submit.prevent="Handlesubmit" action="space-y-4">
                <div class="space-y-2">
                    <Label class="mb-2 pl-1" for="Product_name">Name</Label>
                    <Input v-model="forms.nama" type="text" placeholder="Name" name="Product_name"  />
                    <div v-if="forms.errors.nama" class="text-red-600">{{ forms.errors.nama }}</div>
                </div>
                <div class="space-y-4 mt-4">
                    <Label class="mb-2 pl-1" for="Product_Price">Price </Label>
                    <Input v-model="forms.price" type="number" placeholder="Price" name="Product_Price" />
                    <div v-if="forms.errors.price" class="text-red-600">{{ forms.errors.price }}</div>
                </div>
                <div class="space-y-4 mt-4">
                    <Label class="mb-2 pl-1" for="Product_Description">Description </Label>
                    <Input v-model="forms.description" type="text" placeholder="Description"
                        name="Product_Description" />
                    <div v-if="forms.errors.description" class="text-red-600">{{ forms.errors.description }}</div>
                </div>
                <Button class="mt-4" type="submit" :disabled="forms.processing">
                    add a Product
                </Button>
            </form>
        </div>
    </AppLayout>
</template>
