<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import Button from '@/components/ui/button/Button.vue';
import { route } from 'ziggy-js';
import { Rocket, Search } from "lucide-vue-next"
import { Input } from "@/components/ui/input"
import { useDebounce } from '@vueuse/core';
import { ref, watch } from 'vue';
import { Alert, AlertDescription, AlertTitle } from "@/components/ui/alert"
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import Swal from 'sweetalert2';
import {
    Pagination,
    PaginationContent,
    PaginationEllipsis,
    PaginationItem,
    PaginationNext,
    PaginationPrevious,
} from "@/components/ui/pagination"

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'products',
        href: 'products',
    }
]

interface Product {
    id: number,
    image:string,
    nama: string,
    price: number,
    description: string,
}
interface PaginationLinks {
    first: string | null;
    last: string | null;
    prev: string | null;
    next: string | null;
}

interface PaginationMeta {
    current_page: number;
    last_page: number;
    total: number;
}

interface PaginatedProducts {
    data: Product[],
    meta: PaginationMeta,
    links: PaginationLinks
}
interface Props {
    products: PaginatedProducts,
    results: Product[];
}

// get props from inertia
const props = defineProps<Props>();
const page = usePage()


const Deleteitem = (productid) => {
    Swal.fire({
        title: 'Are you sure?',
        text: 'you wont back to delete  this product again',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "ya",
        cancelButtonText: 'gajadi'
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('products.destroy', productid))
        }
    })
};




const searchQuery = ref('');
const debouceQuery = useDebounce(searchQuery, 500);

watch(debouceQuery, (value) => {
    router.get(route('search.query', { q: value }), {}, { preserveState: true })
})

 

</script>

<template>
    <Head title="products" />
    <AppLayout :breadcrumbs="breadcrumbs">
    
        <div v-if="page.props.flash?.message">
            <Alert>
                <Rocket class="h-4 w-4" />
                <AlertTitle>Heads up!</AlertTitle>
                <AlertDescription>
                    {{ page.props.flash.message }}
                </AlertDescription>
            </Alert>
        </div>

        <div v-if="page.props.flash?.update">
            <Alert>
                <Rocket class="h-4 w-4" />
                <AlertTitle>Heads up!</AlertTitle>
                <AlertDescription>
                    {{ page.props.flash.update }}
                </AlertDescription>
            </Alert>
        </div>
        <div v-if="page.props.flash?.delete">
            <Alert>
                <Rocket class="h-4 w-4" />
                <AlertTitle>Heads up!</AlertTitle>
                <AlertDescription>
                    {{ page.props.flash.delete }}
                </AlertDescription>
            </Alert>
        </div>
        <div>
            <div class="relative w-full max-w-sm items-center right-0">
                <Input id="search" type="text" placeholder="Search..." class="pl-10" v-model="searchQuery" />
                <span class="absolute start-0 inset-y-0 flex items-center justify-center px-2">
                    <Search class="size-6 text-muted-foreground" />
                </span>
            </div>
            <div v-if="props.results && props.results.length">
                <h2 class="mt-4 font-semibold">Hasil Pencarian:</h2>
                <ul>
                    <li v-for="item in props.results" :key="item.id">
                        {{ item.nama }} - Rp{{ item.price }}
                    </li>
                </ul>
            </div>  
            <Table>

                <TableCaption> Product Yang Tersedia</TableCaption>
                <TableCaption v-if="props.products?.meta">
                    Menampilkan halaman {{ props.products.meta.current_page }}
                    dari {{ props.products.meta.last_page }}
                </TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]">Id</TableHead>
                        <TableHead class="w-[100px]">Image</TableHead>
                        <TableHead class="w-[100px]">Nama</TableHead>
                        <TableHead class="w-[100px]">Price</TableHead>
                        <TableHead class="w-[100px]">Description</TableHead>
                        <TableHead class="w-[100px]">Update</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>

                    <TableRow v-for="Product in props.products.data" :key="Product.id">
                        <TableCell>{{ Product.id }}</TableCell>
                        <TableCell><img :src="Product.image" alt=""></TableCell>
                        <TableCell class="font-medium">{{ Product.nama }}</TableCell>
                        <TableCell>{{ Product.price }}</TableCell>
                        <TableCell>{{ Product.description }}</TableCell>
                        <TableCell class="space-x-4">

                            <Link :href="route('products.edit', { id: Product.id })">
                            <Button>Edit</Button>
                            </Link>
                            <Link>
                            <Button @click="Deleteitem(Product.id)">Delete</Button>
                            </Link>
                        </TableCell>

                    </TableRow>
                </TableBody>

            </Table>
            <Pagination :items-per-page="10">

                <PaginationItem v-for="(links, i) in props.products.links.pages" :key="i"
                    class="justify-content-center mx-4 ">
                    <Button :disabled="!links.url" :variant="links.active ? 'default' : 'outline'"
                        @click="() => links.url && router.visit(links.url)" class="mx-20">
                        <span class="" v-html="links.label"></span>
                    </Button>
                </PaginationItem>
            </Pagination>
        </div>
        <div class="p-4">
            <Link :href="route('products.create')">
            <Button>Create a Product</Button>
            </Link>
        </div>
    </AppLayout>
</template>
