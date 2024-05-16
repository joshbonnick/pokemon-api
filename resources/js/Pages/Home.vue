<script setup>
import Layout from '@/Components/Layouts/Guest.vue'
import PikachuBanner from '@/Components/Pages/Home/PikachuBanner.vue'
import PokemonCard from '@/Components/Pokemon/Card.vue'
import Search from '@/Components/Search.vue'
import Pagination from '@/Components/Pagination.vue'
import { reactive, ref, watch } from 'vue'
import { useSearch } from '@/Composables/search.js'

const search = ref('')

watch(search, (value) => {
    useSearch(value).then((result) => {
        pokemon.data = result.data.data
        pokemonCount.value = pokemon.data.length
    })
})

const props = defineProps({ pokemon: Object, pokemon_count: Number })

const pokemon = reactive(props.pokemon)
const pokemonCount = ref(props.pokemon_count)
</script>

<template>
    <Layout title="Welcome">
        <PikachuBanner title="Metus posuere">
            <p>Proin lacinia varius placerat. Vivamus vitae leo lacus. Nam egestas nulla a erat condimentum cursus.
                Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in
                dolor vitae metus posuere ornare quis sed lectus. Orci varius natoque penatibus et magnis dis parturient
                montes, nascetur ridiculus mus.</p>
            <div>
                <a href="#pokemon" class="call-to-action mt-4">
                    Browse Pokémon <i class="fa-solid fa-angle-down"></i>
                </a>
            </div>
        </PikachuBanner>

        <div class="container mx-auto">
            <h3 class="lg:pb-12 pt-8 text-4xl font-bold tracking-widest">{{ pokemonCount }} Pokémon</h3>
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <Search v-model="search"/>
                </div>
                <div class="col-span-12 lg:col-span-2">
                </div>
                <div class="col-span-12 lg:col-span-6">
                    <div class="flex justify-end" v-show="search.length <= 0">
                        <Pagination class="mt-10" :links="pokemon.links"/>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-5 mt-8 mb-12" id="pokemon">
                <PokemonCard v-for="poke in pokemon.data" :pokemon="poke"></PokemonCard>
            </div>

            <div class="flex justify-center" v-show="search.length <= 0">
                <Pagination class="mt-12 mb-24" :links="pokemon.links"/>
            </div>
        </div>
    </Layout>
</template>
