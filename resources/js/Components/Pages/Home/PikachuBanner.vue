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
                        <h1 class="pt-12 lg:pt-0 text-center lg:text-left text-3xl lg:text-5xl mb-0 lg:mb-8 font-bold uppercase tracking-widest font-poetsen">
                            {{ title }}
                        </h1>
                        <slot/>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-5">
                    <img src="/images/pokemon-5426712_1280.png" alt="Pokemon" class="hidden lg:block mb-[-30%] w-full"
                         draggable="false">
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
