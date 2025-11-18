<script setup lang="ts">
import { Icon } from "@iconify/vue";

</script>

<template>


        <footer class="footer sm:footer-horizontal bg-neutral text-neutral-content grid-rows-2 p-10">
            <nav>
                <h6 class="footer-title">Services</h6>
                <a class="link link-hover">Branding</a>
                <a class="link link-hover">Design</a>
                <a class="link link-hover">Marketing</a>
                <a class="link link-hover">Advertisement</a>
            </nav>
            <nav>
                <h6 class="footer-title">Company</h6>
                <a class="link link-hover">About us</a>
                <a class="link link-hover">Contact</a>
                <a class="link link-hover">Jobs</a>
                <a class="link link-hover">Press kit</a>
            </nav>
            <nav>
                <h6 class="footer-title">Legal</h6>
                <a class="link link-hover">Terms of use</a>
                <a class="link link-hover">Privacy policy</a>
                <a class="link link-hover">Cookie policy</a>
            </nav>
            <nav>
                <h6 class="footer-title">Social</h6>
                <a class="link link-hover">Twitter</a>
                <a class="link link-hover">Instagram</a>
                <a class="link link-hover">Facebook</a>
                <a class="link link-hover">GitHub</a>
            </nav>
            <nav>
                <h6 class="footer-title">Explore</h6>
                <a class="link link-hover">Features</a>
                <a class="link link-hover">Enterprise</a>
                <a class="link link-hover">Security</a>
                <a class="link link-hover">Pricing</a>
            </nav>
            <nav>
                <h6 class="footer-title">Apps</h6>
                <a class="link link-hover">Mac</a>
                <a class="link link-hover">Windows</a>
                <a class="link link-hover">iPhone</a>
                <a class="link link-hover">Android</a>
            </nav>
            
  
                <div class="gap-2 ">
                    <div class="flex  gap-3 ">
                        <a href="https://www.instagram.com/dvn_delvin/">
                            <Icon icon="mdi:instagram" width="35" :inline="true" class="text-[#E1306C]" />
                        </a>
                        <p class="text-xl pt-1 text-white">@dvn_delvin</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="https://www.youtube.com/windahbasudara">
                            <Icon icon="mdi:youtube" width="35" class="text-red-700" />
                        </a>
                        <p class="text-xl pt-1 text-white capitalize">windah basudara</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="https://www.tiktok.com/@pelvinaru">
                            <Icon icon="ic:baseline-tiktok" width="35" class="text-white border rounded-full  border-white" />
                        </a>
                        <p class="text-xl pt-1 text-white capitalize">pelvinaru</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="https://www.facebook.com/windahbasudara">
                            <Icon icon="mdi:facebook" width="35" class="text-blue-600" />
                        </a>
                        <p class="text-xl pt-1 text-white capitalize">windah basudara</p>
                    </div>
             
                </div>
    
        
        </footer>

</template>