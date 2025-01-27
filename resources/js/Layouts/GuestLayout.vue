<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 dark:text-white dark:bg-gray-800 sm:justify-center sm:pt-0"
    >
        <div>
            <Link href="/" class="flex flex-row items-center">
                <ApplicationLogo class="w-20 h-20 text-gray-500 fill-current" />
                <h1 class="text-4xl font-black">FlashLearn</h1>
            </Link>
        </div>

        <div
            class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md dark:text-white dark:bg-gray-900 sm:max-w-md sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
