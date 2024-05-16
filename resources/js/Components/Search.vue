<script setup>
import { computed, onMounted, ref } from 'vue'

const props = defineProps(['modelValue'])
defineEmits(['update:modelValue'])

const inputClass = ref('w-full pl-10 p-3 pb-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent shadow-sm')

const iconClass = ref('text-gray-500 fa-solid fa-search')

const placeholder = computed(() => {
    let isMac = navigator.userAgent.indexOf('Mac') >= 0
    return isMac ? '⌘ F' : 'Ctrl F'
})

onMounted(() => {
    document.addEventListener('keydown', (event) => {
        if (event.ctrlKey === true && event.key === 'f') {
            event.preventDefault()
            document.getElementById('poke-search').focus()

            return false
        }
    })
})
</script>
<template>
    <div>
        <label for="poke-search" class="mb-2">Search Pokemon Index</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                <i :class="iconClass"></i>
            </div>
            <input v-bind="$attrs" id="poke-search" :class="inputClass" :placeholder="placeholder"
                   type="search"
                   @change="$emit('update:modelValue', ($event.target).value)"
                   @input="$emit('update:modelValue', ($event.target).value)"/>
        </div>
    </div>
</template>
