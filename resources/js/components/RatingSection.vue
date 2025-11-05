<script setup lang="ts">
defineProps({
  ratings: Array
})
</script>

<template>
  <section class="w-full h-32 mt-10 flex justify-center">
    <div class="w-full max-w-6xl overflow-hidden">
      <div class="flex animate-slide-left gap-3 py-2">
        <div v-for="r in ratings" :key="r.id"
          class="inline-block bg-gray-100 text-center p-3 rounded-xl flex-shrink-0 w-48">
          <p class="font-bold text-black underline">{{ r.user }}</p>
          <p class="text-black">{{ r.Ratings }}</p>
          <div class="rating rating-sm flex items-center justify-center">
            <div v-for="n in 5" :key="n" class="mask mask-star"
                 :class="n <= r.Bintang ? 'bg-orange-400' : 'bg-gray-400'"
                 :aria-current="n === r.Bintang"></div>
          </div>
        </div>

        <div v-for="r in ratings" :key="r.id"
          class="inline-block bg-gray-100 text-center p-3 rounded-xl flex-shrink-0 w-48">
          <p class="font-bold text-black underline">{{ r.user }}</p>
          <p class="text-black">{{ r.Ratings }}</p>
          <div class="rating rating-sm  flex items-center justify-center">
            <div v-for="n in 5" :key="n" class="mask mask-star"
                 :class="n <= r.Bintang ? 'bg-orange-400' : 'bg-gray-400'"
                 :aria-current="n === r.Bintang"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
@keyframes slide-left {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}

.animate-slide-left {
  animation: slide-left 20s linear infinite;
  will-change: transform;
  display: flex;
  width: max-content;
}


</style>
