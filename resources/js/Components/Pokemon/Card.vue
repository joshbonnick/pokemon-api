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
        <h3 class="my-4 text-3xl capitalize">{{ pokemon.name }}</h3>
    </Link>
</template>
