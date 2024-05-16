<script setup>
import { computed } from 'vue'

const props = defineProps({
    pokemon: Object,
    style: {
        type: String, default: 'front_default'
    }
})
const formSprite = computed(() => props.pokemon.forms[0].sprites)
</script>

<template>
    <img :src="formSprite[style]" :alt="pokemon.name"
         style="image-rendering: pixelated" draggable="false" loading="lazy">
</template>

