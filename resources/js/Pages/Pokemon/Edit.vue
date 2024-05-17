<script setup>
import Layout from '@/Components/Layouts/Guest.vue'
import { reactive, ref } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({ pokemon: Object, related: Array })

const name = props.pokemon.name.charAt(0).toUpperCase() + props.pokemon.name.slice(1)

const cry = ref(null)

const data = reactive(props.pokemon)

const update = () => {
    axios.post(`/api/v1/pokemon/${props.pokemon.id}`,
        { name: data.name, _method: 'patch' }
    ).then(() => {
        alert(`${data.name} has been updated successfully`)
    }).catch((error) => {
        if (error.response.data.message) {
            alert(`${error.response.data.message}`)
            return
        }

        console.error(error)
    })
}
</script>

<template>
    <Layout :title="`${name}`">
        <div class="container mx-auto mt-8 px-4">
            <Link :href="`/pokemon/${pokemon.id}`" class="w-full lg:w-auto call-to-action mt-4">
                <i class="fa-solid fa-angle-left"></i> View {{ pokemon.name }}
            </Link>
            <audio :src="pokemon.cry" class="hidden" ref="cry"></audio>

            <form class="pt-12 lg:pt-18" @submit.prevent="update">
                <div class="grid grid-cols-12">
                    <div class="col-span-12 lg:col-span-4">
                        <div class="flex items-center justify-center lg:justify-start mb-4 lg:mb-8 space-x-4">
                            <input type="text" v-model="data.name">
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-12">
                        <button class="call-to-action">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </Layout>
</template>
