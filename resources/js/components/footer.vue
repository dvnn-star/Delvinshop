<script setup lang="ts">
import { Icon } from "@iconify/vue";

</script>

<template>
    <footer class="w-full border h-40  bg-black mt-24">
        <div class="w-full">
            <div class="gap-4 ml-2">
                <div class="flex  gap-3 ">
                    <a href="https://www.instagram.com/dvn_delvin/">
                        <Icon icon="mdi:instagram" width="40" :inline="true" class="text-[#E1306C]" />
                    </a>
                    <p class="text-xl pt-1 text-white">@dvn_delvin</p>
                </div>
                <div class="flex gap-3">
                    <a href="https://www.youtube.com/windahbasudara">
                        <Icon icon="mdi:youtube" width="40" class="text-red-700" />
                    </a>
                    <p class="text-xl pt-1 text-white capitalize">windah basudara</p>
                </div>
                <div class="flex gap-3">
                    <a href="https://www.tiktok.com/@pelvinaru">
                        <Icon icon="ic:baseline-tiktok" width="40" class="text-white border rounded-full  border-white" />
                    </a>
                    <p class="text-xl pt-1 text-white capitalize">pelvinaru</p>
                </div>
                <div class="flex gap-3">
                    <a href="https://www.facebook.com/windahbasudara">
                        <Icon icon="mdi:facebook" width="40" class="text-blue-600" />
                    </a>
                    <p class="text-xl pt-1 text-white capitalize">windah basudara</p>
                </div>
            </div>
            <div>
                <p class="text-black">&copy</p>
            </div>
        </div>
    </footer>
</template>