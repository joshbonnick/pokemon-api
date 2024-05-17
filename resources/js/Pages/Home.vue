<script setup>
import Layout from '@/Components/Layouts/Guest.vue'
import PikachuBanner from '@/Components/Pages/Home/PikachuBanner.vue'
import PokemonCard from '@/Components/Pokemon/Card.vue'
import Search from '@/Components/Search.vue'
import Pagination from '@/Components/Pagination.vue'
import { reactive, ref } from 'vue'
import { useSearch } from '@/Composables/search.js'
import Select from '@/Components/Select.vue'

const search = ref('')
const sortByStat = ref(false)

const triggerSearch = () => {
    useSearch({ s: search.value, stat_sort: sortByStat.value }).then((result) => {
        pokemon.data = result.data.data
        pokemonCount.value = pokemon.data.length
    })
}

const props = defineProps({ pokemon: Object, pokemon_count: Number, stats: Object })

const pokemon = reactive(props.pokemon)
const pokemonCount = ref(props.pokemon_count)
</script>

<template>
    <Layout title="Welcome">
        <PikachuBanner title="Pokédex">
            <div class="text-center lg:text-left">
                <a href="#pokemon" class="call-to-action my-8 lg:mb-0 lg:mt-4">
                    Browse Pokémon <i class="fa-solid fa-angle-down"></i>
                </a>
            </div>
        </PikachuBanner>

        <div class="container mx-auto px-4 text-center lg:text-left">
            <h3 class="pb-8 lg:pb-12 pt-8 text-xl lg:text-4xl font-bold tracking-widest">{{ pokemonCount }} Pokémon</h3>
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <Search v-model="search" @update:model-value="triggerSearch"/>
                </div>
                <div class="col-span-12 lg:col-span-4">
                    <Select :options="stats" v-model="sortByStat" @update:model-value="triggerSearch">Sort By
                        Stat
                    </Select>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 mt-8 mb-12" id="pokemon">
                <PokemonCard v-for="poke in pokemon.data" :pokemon="poke"></PokemonCard>
            </div>

            <div class="flex justify-center" v-show="search.length <= 0">
                <Pagination class="mt-12 mb-24" :links="pokemon.links"/>
            </div>
        </div>
    </Layout>
</template>
