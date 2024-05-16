<script setup>
import Layout from '@/Components/Layouts/Guest.vue'
import Sprite from '@/Components/Pokemon/Sprite.vue'

const props = defineProps({ pokemon: Object })

const name = props.pokemon.name.charAt(0).toUpperCase() + props.pokemon.name.slice(1)
</script>

<template>
    <Layout :title="`${name}`">
        <div class="container mx-auto mt-8">
            <article>
                <div class="flex items-center justify-between">
                    <h1 class="text-5xl mb-4 lg:mb-8 font-bold uppercase tracking-widest font-poetsen">
                        {{ pokemon.name }}
                    </h1>
                    <Sprite :pokemon="pokemon" class="w-1/3 absolute top-0 right-0"/>
                </div>
                {{ pokemon }}
            </article>
        </div>
    </Layout>
</template>
