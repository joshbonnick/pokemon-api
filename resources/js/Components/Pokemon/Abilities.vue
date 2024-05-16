<script setup>

defineProps({ abilities: Array })
</script>

<template>
    <div>
        <h2 class="text-xl font-bold mb-4 uppercase tracking-widest font-poetsen">Abilities</h2>
        <ol>
            <li v-for="ability in abilities" class="capitalize mb-4">
                {{ ability.name }}
            </li>
        </ol>
    </div>
</template>
