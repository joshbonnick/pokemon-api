<script setup>
const props = defineProps({ pokemon: Object })
const formSprite = props.pokemon.forms[0]
</script>

<template>
    <img :src="formSprite.sprite.front_default" :alt="pokemon.name"
         style="image-rendering: pixelated" draggable="false" loading="lazy">
</template>

