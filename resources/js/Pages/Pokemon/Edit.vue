<script setup>
import Layout from '@/Components/Layouts/Guest.vue'
import { onMounted, reactive, ref } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({ pokemon: Object, related: Array })

const name = props.pokemon.name.charAt(0).toUpperCase() + props.pokemon.name.slice(1)

const cry = ref(null)

const data = reactive(props.pokemon)

const update = () => {
    axios.post(`/api/v1/pokemon/${props.pokemon.id}`,
        { ...data, _method: 'patch' }
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
const nameInput = ref(null)

onMounted(() => {
    nameInput.value.focus()
})

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
                        <label for="name" class="!mt-0">Name</label>
                        <input type="text" id="name" v-model="data.name" ref="nameInput">

                        <label for="base_exp">Base Experience</label>
                        <input type="number" id="base_exp" v-model="data.base_experience">

                        <label for="weight">Weight (kg)</label>
                        <input type="number" id="weight" v-model="data.weight">

                        <label for="height">Height (m)</label>
                        <input type="number" v-model="data.height">

                        <label for="order">Order</label>
                        <input type="number" id="order" v-model="data.order">
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
