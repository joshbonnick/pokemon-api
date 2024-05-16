<script setup>
import Layout from '@/Components/Layouts/Guest.vue'
import Sprite from '@/Components/Pokemon/Sprite.vue'
import { ref } from 'vue'

const props = defineProps({ pokemon: Object })

const name = props.pokemon.name.charAt(0).toUpperCase() + props.pokemon.name.slice(1)

const cry = ref(null)
</script>

<template>
    <Layout :title="`${name}`">
        <div class="container mx-auto mt-8">
            <audio :src="pokemon.cry" class="hidden" ref="cry"></audio>

            <article>
                <div class="grid grid-cols-12">
                    <div class="col-span-12 lg:col-span-8">
                        <div class="flex items-center mb-4 lg:mb-8 space-x-4">
                            <h1 class="text-5xl font-bold uppercase tracking-widest font-poetsen">
                                {{ pokemon.name }}
                            </h1>
                            <button @click="cry.play()" :title="`Play ${pokemon.name} sound`"
                                    :aria-label="`Play ${pokemon.name} sound`">
                                <i class="fa-solid fa-volume-high text-xl align-middle"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-12">
                            <div class="col-span-12 lg:col-span-6">
                                <div class="bg-gray-100 p-6">
                                    <h2 class="text-xl font-bold mb-4 uppercase tracking-widest font-poetsen">Stats</h2>
                                    <ul>
                                        <li v-for="(value, name) in pokemon.stats"
                                            class="flex items-center justify-between">
                                            <p class="uppercase text-xs !mb-0">{{ name }}</p>
                                            <p class="text-sm font-bold">{{ value }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-span-12 lg:col-span-6">
                                <ul class="flex items-center flex-wrap">
                                    <li class="flex-[0_0_50%]">
                                        <p class="text-sm font-bold mb-0 uppercase tracking-widest font-poetsen">
                                            Height</p>
                                        <p class="text-4xl">{{ pokemon.height }}m</p>
                                    </li>
                                    <li class="flex-[0_0_50%]">
                                        <p class="text-sm font-bold mb-0 uppercase tracking-widest font-poetsen">
                                            Weight</p>
                                        <p class="text-4xl">{{ pokemon.weight }}kg</p>
                                    </li>
                                    <li class="flex-[0_0_50%]">
                                        <p class="text-sm font-bold mb-0 uppercase tracking-widest font-poetsen">Base
                                            Experience</p>
                                        <p class="text-4xl">{{ pokemon.base_experience }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-4">
                        <Sprite :pokemon="pokemon" class="w-full" :style="'front_shiny'"/>
                    </div>
                </div>
            </article>
        </div>
    </Layout>
</template>
