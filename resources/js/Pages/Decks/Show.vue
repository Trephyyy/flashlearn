<template>
    <Head :title="`View ${flashcardSet.name}`" />
    <NavigationLayout>
        <div class="w-screen min-h-screen dark:text-white dark:bg-slate-900">
            <div class="container p-4 mx-auto">
                <div class="flex flex-row items-center justify-between my-5">
                    <div class="flex flex-row items-center">
                        <h1 class="text-2xl font-bold">
                            {{ flashcardSet.name }}
                        </h1>
                        <Link
                            :href="`/decks/${flashcardSet.id}/edit`"
                            class="ml-4 text-orange-500 rounded"
                        >
                            Edit
                        </Link>
                    </div>
                    <Link
                        :href="`/decks/${flashcardSet.id}/revise`"
                        class="px-4 py-2 text-white bg-blue-500 rounded dark:bg-indigo-700 hover:bg-blue-700"
                    >
                        Revise
                    </Link>
                </div>

                <div
                    v-for="flashcard in flashcardSet.flashcards"
                    :key="flashcard.id"
                    class="p-6 mt-2 mb-4 bg-white rounded-lg shadow-md dark:bg-slate-800"
                >
                    <h2
                        class="mb-2 text-xl font-bold text-black dark:text-white"
                    >
                        {{ flashcard.question }}
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300">
                        {{ flashcard.answer }}
                    </p>
                    <Link
                        :href="`/flashcards/${flashcard.id}/edit`"
                        class="mt-2 text-blue-500 hover:underline"
                    >
                        Edit
                    </Link>
                </div>
            </div>
        </div></NavigationLayout
    >
</template>

<script setup>
import NavigationLayout from "@/Layouts/NavigationLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
const props = defineProps(["flashcardSet"]);
</script>

<style scoped>
.container {
    max-width: 600px;
}
</style>
