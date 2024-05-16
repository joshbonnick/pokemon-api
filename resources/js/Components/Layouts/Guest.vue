<script setup>
import { Head, Link } from '@inertiajs/vue3'

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
    <header class="bg-gray-50 fixed top-0 left-0 right-0 z-[500] border-b border-black/20">
        <div class="container mx-auto">
            <div class="flex items-center justify-between py-2">
                <div class="flex space-x-4 items-center">
                    <Link href="/"><img src="/images/logo.webp" alt="Pokemon Logo" class="w-16 mr-6"></Link>
                    <Link href="/">Pokémon Index</Link>
                </div>
                <nav>

                </nav>
            </div>
        </div>
    </header>
    <main class="pt-[80px]">
        <article>
            <slot/>
        </article>
    </main>
</template>
