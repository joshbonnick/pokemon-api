<script setup>
import { ref } from 'vue'

defineProps({ options: Array, modelValue: String | Boolean })
defineEmits(['update:modelValue'])

const inputClass = ref('w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent shadow-sm')

</script>
//stat_sort
<template>
    <div>
        <label class="mb-2">
            <slot/>
        </label>
        <div class="relative">
            <select v-bind="$attrs" :class="inputClass"
                    @change="$emit('update:modelValue', ($event.target).value)">
                <option value="false">Select a stat...</option>
                <option v-for="value in options" :value="value">{{ value }}</option>
            </select>
        </div>
    </div>
</template>
