<script setup>
import Layout from '@/Components/Layouts/Guest.vue'
import PikachuBanner from '@/Components/Pages/Home/PikachuBanner.vue'
import PokemonCard from '@/Components/Pokemon/Card.vue'
import Search from '@/Components/Search.vue'

defineProps({ pokemon: Array, pokemon_count: Number })
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
            <h3 class="lg:pb-12 pt-8 text-4xl font-bold tracking-widest">{{ pokemon_count }} Pokémon</h3>
            <div class="grid grid-cols-12">
                <div class="col-span-12 lg:col-span-4">
                    <Search/>
                </div>
                <div class="col-span-12 lg:col-span-4">
                </div>
                <div class="col-span-12 lg:col-span-4">
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-5 mt-8" id="pokemon">
                <PokemonCard v-for="poke in pokemon" :pokemon="poke"></PokemonCard>
            </div>
        </div>
    </Layout>
</template>
