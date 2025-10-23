<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
  inheritAttrs: false,
});

interface Props {
  className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
  <img
    src="/img/kirby.jpeg"
    alt="Delvin Shop Logo"
    class="h-10 w-10 rounded-full object-cover"
    :class="className"
    v-bind="$attrs"
  />
</template>
