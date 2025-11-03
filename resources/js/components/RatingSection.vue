<script setup lang="ts">
defineProps({
    ratings: Array
})
</script>

<template>
    <section class=" w-full h-32 mt-10 flex">
        <div class="flex flex-wrap gap-3 pl-4 py-2 mx-auto max-w-7xl justify-center">
            <div v-for="ratings in ratings"
                class="inline-block bg-gray-100 text-center p-3 rounded-xl flex-shrink-0 w-48" :key="ratings.id">
                <p class="font-bold text-black underline">{{ ratings.user }}</p>
                <p class="text-black  ">{{ ratings.Ratings }}</p>
               
                    <div class="rating rating-sm w-30  items-center   justify-center " >
                        <div  v-for="n in 5" :key="n" class="mask mask-star bg-black" :class="n <=  ratings.Bintang ? 'bg-orange-400' : 'bg-gray-400'" :aria-current="n === ratings.Bintang ? true : false"></div>

                    </div>
                
            </div>
        </div>
    </section>

</template>