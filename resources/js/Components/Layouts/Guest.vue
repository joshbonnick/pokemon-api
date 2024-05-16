<script setup>
import { Head } from '@inertiajs/vue3'

defineProps({
    title: {
        type: String,
        default: 'test'
    }
})
</script>

<template>
    <Head :title="title ? `${title} - Pokémon` : 'Pokémon'">
    </Head>
    <main>
        <article>
            <slot/>
        </article>
    </main>
</template>
