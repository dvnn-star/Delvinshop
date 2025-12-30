<script setup lang="ts">
import { Icon } from "@iconify/vue";
</script>

<template>
  <footer class="bg-neutral text-neutral-content">
    <div class="footer p-10 grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-8">
      <nav>
        <h6 class="footer-title opacity-100 text-white">Services</h6>
        <a class="link link-hover text-gray-400 hover:text-white">Branding</a>
        <a class="link link-hover text-gray-400 hover:text-white">Design</a>
        <a class="link link-hover text-gray-400 hover:text-white">Marketing</a>
        <a class="link link-hover text-gray-400 hover:text-white">Advertisement</a>
      </nav>
      <nav>
        <h6 class="footer-title opacity-100 text-white">Company</h6>
        <a class="link link-hover text-gray-400 hover:text-white">About us</a>
        <a class="link link-hover text-gray-400 hover:text-white">Contact</a>
        <a class="link link-hover text-gray-400 hover:text-white">Jobs</a>
      </nav>
      <nav>
        <h6 class="footer-title opacity-100 text-white">Legal</h6>
        <a class="link link-hover text-gray-400 hover:text-white">Terms of use</a>
        <a class="link link-hover text-gray-400 hover:text-white">Privacy policy</a>
      </nav>
      <nav>
        <h6 class="footer-title opacity-100 text-white">Explore</h6>
        <a class="link link-hover text-gray-400 hover:text-white">Features</a>
        <a class="link link-hover text-gray-400 hover:text-white">Enterprise</a>
        <a class="link link-hover text-gray-400 hover:text-white">Pricing</a>
      </nav>

      <div class="col-span-2">
        <h6 class="footer-title opacity-100 text-white">Get in touch</h6>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
          
          <a href="https://www.instagram.com/dvn_delvin/" class="flex items-center gap-3 group">
            <div class="p-2 bg-white/5 rounded-lg group-hover:bg-white/10 transition-colors">
              <Icon icon="mdi:instagram" width="24" class="text-[#E1306C]" />
            </div>
            <span class="text-sm group-hover:text-white transition-colors">@dvn_delvin</span>
          </a>

          <a href="https://www.youtube.com/windahbasudara" class="flex items-center gap-3 group">
            <div class="p-2 bg-white/5 rounded-lg group-hover:bg-white/10 transition-colors">
              <Icon icon="mdi:youtube" width="24" class="text-[#FF0000]" />
            </div>
            <span class="text-sm group-hover:text-white transition-colors capitalize">Windah Basudara</span>
          </a>

          <a href="https://www.tiktok.com/@pelvinaru" class="flex items-center gap-3 group">
            <div class="p-2 bg-white/5 rounded-lg group-hover:bg-white/10 transition-colors">
              <Icon icon="ic:baseline-tiktok" width="24" class="text-white" />
            </div>
            <span class="text-sm group-hover:text-white transition-colors">@pelvinaru</span>
          </a>

          <a href="https://www.facebook.com/windahbasudara" class="flex items-center gap-3 group">
            <div class="p-2 bg-white/5 rounded-lg group-hover:bg-white/10 transition-colors">
              <Icon icon="mdi:facebook" width="24" class="text-[#1877F2]" />
            </div>
            <span class="text-sm group-hover:text-white transition-colors capitalize">Windah Basudara</span>
          </a>

        </div>
      </div>
    </div>

    <div class="footer footer-center p-4 bg-base-300 text-base-content border-t border-white/5">
      <aside>
        <p class="text-xs opacity-70">Copyright © {{ new Date().getFullYear() }} - All right reserved by Delvin</p>
      </aside>
    </div>
  </footer>
</template>