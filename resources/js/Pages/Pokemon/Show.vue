<script setup>
import Layout from '@/Components/Layouts/Guest.vue'
import { ref } from 'vue'
import Abilities from '@/Components/Pokemon/Abilities.vue'
import { Link } from '@inertiajs/vue3'
import Sprite from '@/Components/Pokemon/Sprite.vue'
import PokemonCard from '@/Components/Pokemon/Card.vue'

const props = defineProps({ pokemon: Object, related: Array })

const name = props.pokemon.name.charAt(0).toUpperCase() + props.pokemon.name.slice(1)

const cry = ref(null)
</script>

<template>
    <Layout :title="`${name}`">
        <div class="container mx-auto mt-8 px-4">
            <Link href="/" class="w-full lg:w-auto call-to-action mt-4">
                <i class="fa-solid fa-angle-left"></i> Browse Pokémon
            </Link>
            <Link :href="`/pokemon/${pokemon.id}/edit`" class="w-full lg:w-auto call-to-action mt-4 lg:ml-4">
                <i class="fa-solid fa-pencil"></i> Edit {{ pokemon.name }}
            </Link>
            <audio :src="pokemon.cry" class="hidden" ref="cry"></audio>

            <article class="pt-12 lg:pt-18">
                <div class="grid grid-cols-12">
                    <div class="col-span-12 lg:col-span-4">
                        <div class="flex items-center justify-center lg:justify-start mb-4 lg:mb-8 space-x-4">
                            <h1 class="text-3xl lg:text-5xl font-bold uppercase tracking-widest font-poetsen">
                                {{ pokemon.name }}
                            </h1>
                            <button @click="cry.play()" :title="`Play ${pokemon.name} sound`"
                                    :aria-label="`Play ${pokemon.name} sound`">
                                <i class="fa-solid fa-volume-high text-xl align-middle"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-4 lg:grid-cols-2 bounce lg:min-h-[490px]">
                            <Sprite :pokemon="pokemon" :style="'front_default'" class="w-full"/>
                            <Sprite :pokemon="pokemon" :style="'back_default'" class="w-full"/>
                            <Sprite :pokemon="pokemon" :style="'front_shiny'" class="w-full"/>
                            <Sprite :pokemon="pokemon" :style="'back_shiny'" class="w-full"/>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-4">
                        <div class="mb-8">
                            <h2 class="text-xl font-bold mb-4 uppercase tracking-widest font-poetsen">Stats</h2>
                            <ul>
                                <li v-for="(value, name) in pokemon.stats"
                                    class="flex items-center justify-between">
                                    <p class="uppercase text-xs !mb-0">{{ name }}</p>
                                    <p class="text-sm font-bold">{{ value }}</p>
                                </li>
                            </ul>
                        </div>
                        <ul class="flex items-center flex-wrap">
                            <li class="flex-[0_0_50%]">
                                <p class="text-sm font-bold mb-0 uppercase tracking-widest font-poetsen">
                                    Height</p>
                                <p class="text-4xl">
                                    {{ pokemon.height }}<span class="text-sm">m</span>
                                </p>
                            </li>
                            <li class="flex-[0_0_50%]">
                                <p class="text-sm font-bold mb-0 uppercase tracking-widest font-poetsen">
                                    Weight</p>
                                <p class="text-4xl">
                                    {{ pokemon.weight }}<span class="text-sm">kg</span>
                                </p>
                            </li>
                            <li class="flex-[0_0_50%]">
                                <p class="text-sm font-bold mb-0 uppercase tracking-widest font-poetsen">
                                    Base Experience
                                </p>
                                <p class="text-4xl">
                                    {{ pokemon.base_experience }}<span class="text-sm">xp</span>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-span-12 lg:col-span-4">
                        <Abilities :abilities="pokemon.abilities"/>
                    </div>
                </div>
            </article>
            <div class="grid grid-cols-2 lg:grid-cols-5 mt-8 mb-12">
                <PokemonCard v-for="poke in related" :pokemon="poke"></PokemonCard>
            </div>
        </div>
    </Layout>
</template>
