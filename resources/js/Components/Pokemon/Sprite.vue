<script setup>
import { computed } from 'vue'

const props = defineProps({ pokemon: Object })
const formSprite = computed(() => props.pokemon.forms[0])
</script>

<template>
    <img :src="formSprite.sprite.front_default" :alt="pokemon.name"
         style="image-rendering: pixelated" draggable="false" loading="lazy">
</template>

