<script setup>
import { Link } from '@inertiajs/vue3'
import Sprite from '@/Components/Pokemon/Sprite.vue'

const props = defineProps({
    pokemon: Object
})

</script>

<template>
    <Link :href='`/pokemon/${pokemon.id}`'
          class="text-center p-4 shadow-lg rounded-sm border border-black/10 hover-bounce">
        <Sprite :pokemon="pokemon" class="w-full"/>
        <h3 class="mt-4 text-3xl capitalize mb-8">{{ pokemon.name }}</h3>
        <ul class="grid grid-cols-2 !gap-0">
            <li v-for="(value, name) in pokemon.stats" class="flex items-center justify-between flex-col">
                <p class="uppercase text-xs !mb-0">{{ name }}</p>
                <p class="text-sm font-bold">{{ value }}</p>
            </li>
        </ul>
    </Link>
</template>
