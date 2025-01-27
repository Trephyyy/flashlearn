<template>
    <Head title="Flashcards" />
    <NavigationLayout>
        <div class="w-screen min-h-screen bg-white dark:bg-slate-900">
            <div class="container p-4 mx-auto dark:text-white">
                <h1 class="mb-4 text-2xl font-bold">Flashcard Sets</h1>
                <div class="space-y-8">
                    <div
                        v-for="set in props.flashcardSets"
                        :key="set.id"
                        class="p-4 mb-6 border rounded dark:border-gray-600 shadowded max-h-20"
                    >
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold">
                                {{ set.name }}
                            </h2>
                            <div class="ml-auto space-x-3">
                                <Link
                                    :href="`/decks/${set.id}/edit`"
                                    class="px-4 py-2 text-white bg-orange-500 rounded dark:bg-orange-700 hover:bg-orange-700"
                                >
                                    Edit
                                </Link>
                                <Link
                                    :href="`/decks/${set.id}`"
                                    class="px-4 py-2 text-white bg-blue-500 rounded dark:bg-indigo-700 hover:bg-blue-700"
                                >
                                    View
                                </Link>
                            </div>
                        </div>

                        <ul>
                            <li
                                v-for="flashcard in set.flashcards"
                                :key="flashcard.id"
                                class="mb-2"
                            >
                                <!-- <div class="font-medium">
                            Q: {{ flashcard.question }}
                        </div>
                        <div class="text-gray-700">
                            A: {{ flashcard.answer }}
                        </div> -->
                            </li>
                        </ul>
                    </div>
                    <div class="flex justify-end mt-4">
                        <Link
                            href="/decks/create"
                            class="px-4 py-2 text-white bg-green-500 rounded dark:hover:bg-green-500 dark:bg-green-700 hover:bg-green-700"
                        >
                            Create Flashcard Set
                        </Link>
                    </div>
                </div>
            </div>
        </div></NavigationLayout
    >
</template>

<script setup>
import { ref, onMounted } from "vue";
import NavigationLayout from "@/Layouts/NavigationLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";

const props = defineProps({
    flashcardSets: {
        type: Array,
    },
    flashcards: {
        type: Array,
    },
});
</script>

<style scoped>
.container {
    max-width: 800px;
}
</style>
