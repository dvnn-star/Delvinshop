<script setup >
import DeleteUser from '@/components/DeleteUser.vue';
import { email } from '@/routes/password';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { route } from 'ziggy-js';

const page = usePage()

const form = useForm({
    name: page.props.name,
    email: page.props.email

})
const Handlesubmit = () => {
    form.put(route('user.update'),{
        onError:(error) => console.error(error),

    })
}
const successmessage = computed(() => page.props.flash.success)
</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white dark:bg-gray-800 p-6 shadow-lg border-r border-gray-200 dark:border-gray-700">
            <h1 class="text-2xl font-bold mb-8">Settings</h1>

            <nav class="space-y-2">
                <button
                    class="w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300">
                    Profile
                </button>
                <Link  :href="route('home')">
                <button class="w-full text-left px-4 py-2 rounded-lg  hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 ">

                        Exit
                    </button>
                </Link>

                </nav>

        </aside>

        <!-- content -->
        <main class="flex-1 p-10">
            
            <section class="space-y-6 mb-20">
                <form @submit.prevent="Handlesubmit">
                    <h2 class="text-2xl font-semibold">Profile</h2>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow space-y-4"> 
                        <label class="block">FullName</label> 
                        <input v-model="form.name"
                            class="w-full px-3 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700" :placeholder="form.name"/>
                        <label class="block">Email</label> 
                        <input v-model="form.email"
                            class="w-full px-3 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700" :placeholder="form.email" /> 
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg" :disabled="form.processing">Save</button>
                        <div v-if="successmessage" class="text-red-600">Data Telah diubah</div>
                    </div>
                </form>
            </section>

            <DeleteUser/>
        </main>
    </div>
</template>
