<template>
    <NavigationLayout>
        <div class="absolute w-screen h-screen -z-10 dark:bg-gray-800"></div>
        <div class="container p-4 mx-auto dark:bg-gray-800">
            <h1 class="mb-4 text-2xl font-bold dark:text-white">
                Edit Flashcard
            </h1>
            <form @submit.prevent="updateFlashcard">
                <div class="mb-4">
                    <label
                        for="question"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >Question</label
                    >
                    <input
                        type="text"
                        id="question"
                        v-model="flashcard.question"
                        class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    />
                </div>
                <div class="mb-4">
                    <label
                        for="answer"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                        >Answer</label
                    >
                    <textarea
                        id="answer"
                        v-model="flashcard.answer"
                        rows="4"
                        class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    ></textarea>
                </div>
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </NavigationLayout>
</template>

<script setup>
import NavigationLayout from "@/Layouts/NavigationLayout.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps(["flashcard"]);

const flashcard = ref({
    id: props.flashcard.id,
    question: "" || props.flashcard.question,
    answer: "" || props.flashcard.answer,
});

const updateFlashcard = () => {
    // Logic to update the flashcard
    console.log("Flashcard updated:", flashcard.value);
    router.put("/flashcards/" + flashcard.value.id, flashcard.value);
};
</script>

<style scoped>
/* Add any additional styles if needed */
</style>
