<script setup>
defineProps({
    title: String,
})
</script>

<template>
    <section class="bg-yellow-400 border-b border-gray-400/80">
        <div class="container mx-auto">
            <div class="grid grid-cols-12 gap-4 lg:gap-8">
                <div class="col-span-12 lg:col-span-4">
                    <div class="h-full flex flex-col justify-center">
                        <h1 class="text-5xl mb-4 lg:mb-8 font-bold uppercase tracking-widest font-poetsen">
                            {{ title }}
                        </h1>
                        <div class="text-lg">
                            <slot/>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-5">
                    <img src="/images/pokemon-5426712_1280.png" alt="Pokemon" class="mb-[-30%] w-full block"
                         draggable="false">
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
