<script setup lang="ts">
import { useForm, usePage } from '@inertiajs/vue3';
import { computed,ref, watch } from 'vue';
import { route } from 'ziggy-js';


const showAlert = ref(false)
const formss  = useForm({
    nama: '',
    message: '',
    bintang: null
})



// reset form dan handle submitnya
const Handlesubmit = () => {
    formss.post(route('forms.store'),{
        preserveScroll: true,
        onError:(error) => console.error(error),
        onSuccess: () => {
            formss.reset()

        }
    })
}
const page = usePage()
const successmessage = computed(() => page.props.flash.success)
watch(successmessage, (val) => {
  if (val) {
    showAlert.value = true
    setTimeout(() => {
      showAlert.value = false
    }, 3000) 
  }
})



</script>
<template>
     <transition name="fade">
    <div
      v-if="showAlert"
      class="fixed top-5 right-5 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg"
    >
      {{ successmessage }}
    </div>
  </transition>   
    <section class="bg-white my-16 ">

        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-xl dark:bg-gray-400 rounded-xl">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Rate Us</h2>
            <form class="space-y-8" @submit.prevent="Handlesubmit">
                <div>
                    <label for="nama" class="block mb-2 text-md font-medium text-gray-900 dark:text-gray-800"> Your Name</label>
                    <input type="text" id="nama" v-model="formss.nama"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                        placeholder="name" required>
                    <div v-if="formss.errors.nama">{{ formss.errors.nama }}</div>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-md font-medium text-gray-900 dark:text-gray-800">Your
                        message(Sederhana saja)</label>
                       
                        <textarea id="message" rows="6" v-model="formss.message"
                            placeholder="Leave a comment..." class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-300 dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                            <div v-if="formss.errors.message">{{ formss.errors.message }}</div>
                        </div>
                        <div>
                        <div class="rating">
                            <input type="radio" name="rating-1"  class="mask mask-star bg-gray-900" aria-label="1 star" value=1 v-model.number="formss.bintang" />
                            <input type="radio" name="rating-1" class="mask mask-star bg-gray-900" aria-label="2 star" value=2 v-model.number="formss.bintang" />
                            <input type="radio" name="rating-1" class="mask mask-star bg-gray-900" aria-label="3 star"  value=3 v-model.number="formss.bintang" />
                            <input type="radio" name="rating-1" class="mask mask-star bg-gray-900" aria-label="4 star" value=4 v-model.number="formss.bintang"/>
                            <input type="radio" name="rating-1" class="mask mask-star bg-gray-900" aria-label="5 star" value=5 v-model.number="formss.bintang" />
                        </div> 
                        <div v-if="formss.errors.bintang">{{ formss.errors.bintang }}</div>
                        </div>
                <button type="submit" :disabled="formss.processing"
                    class=" text-sm font-medium text-center text-black  border py-2 px-2 rounded-lg bg-white sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Send
                    message</button>
                
          </form>
        </div>
    </section>
</template>
<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>