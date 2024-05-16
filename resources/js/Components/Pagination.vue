<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({ links: Array })
</script>

<template>
    <div>
        <Link v-for="link in links" :href="link?.url ?? 'javascript:void(0)'" v-html="link.label"
              preserve-scroll
              :class="{'text-gray-100 cursor-default pointer-events-none hidden': !link.url, 'bg-slate-100': link.active,
                        'bg-slate-50 px-4 py-3 rounded-md border border-black/5 mr-2 hover:bg-slate-200': link.url?.length > 0
                      }"/>
    </div>
</template>

<style scoped>

</style>
