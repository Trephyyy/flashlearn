<template>
    <Head title="Edit Flashcard Set" />
    <NavigationLayout>
        <div
            class="flex items-center justify-center w-screen min-h-[100vh] bg-white dark:bg-slate-900"
        >
            <div
                class="container p-6 mx-auto my-8 space-y-4 bg-white shadow-md dark:bg-gray-800 rounded-xl"
            >
                <h1 class="text-2xl font-bold text-gray-700 dark:text-gray-200">
                    Edit Flashcard Set
                </h1>
                <form @submit.prevent="updateFlashcardSet" class="space-y-4">
                    <div class="form-group">
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                            >Name</label
                        >
                        <input
                            id="name"
                            v-model="flashcardSetName"
                            type="text"
                            class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:text-gray-200 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        />
                    </div>
                    <!--  <div class="form-group">
                        <label
                            for="textInput"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                        >
                            Paste Flashcards
                        </label>
                        <textarea
                            id="textInput"
                            v-model="textInput"
                            placeholder="Paste your flashcards here"
                            class="block w-full h-40 p-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:text-gray-200 dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        ></textarea>
                    </div>

                   
                    <div class="form-group">
                        <label
                            for="wordSeparator"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                        >
                            Word Separator
                        </label>
                        <input
                            id="wordSeparator"
                            v-model="wordSeparator"
                            type="text"
                            class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:text-gray-200 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        />
                    </div>

              
                    <div class="form-group">
                        <label
                            for="customSeparator"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                        >
                            Custom Separator
                        </label>
                        <input
                            id="customSeparator"
                            v-model="customSeparator"
                            type="text"
                            class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:text-gray-200 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        />
                    </div> -->
                    <div class="form-group">
                        <label
                            for="flashcards"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                            >Enter Flashcards by Hand</label
                        >
                        <div
                            v-for="(flashcard, index) in flashcards"
                            :key="index"
                            class="flex items-center gap-4 mb-2 sm:items-start sm:flex-row flashcard"
                        >
                            <div class="flex flex-col w-full gap-1 sm:flex-row">
                                <input
                                    v-model="flashcard.question"
                                    placeholder="Question"
                                    class="block w-full p-2 border border-gray-300 rounded-md shadow-sm dark:text-gray-200 dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                />
                                <input
                                    v-model="flashcard.answer"
                                    placeholder="Answer"
                                    class="block w-full p-2 border border-gray-300 rounded-md shadow-sm dark:text-gray-200 dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                />
                            </div>
                            <button
                                type="button"
                                @click="removeFlashcard(index)"
                                class="inline-flex sm:h-full h-10 items-center dark:bg-red-700 px-2 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            >
                                <iconify-icon
                                    icon="mdi:delete"
                                    class="text-lg"
                                />
                            </button>
                        </div>
                        <button
                            type="button"
                            @click="addFlashcard"
                            class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm dark:text-gray-200 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Add Flashcard
                        </button>
                    </div>
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md shadow-sm dark:bg-green-600 hover:bg-green-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    >
                        Update Flashcard Set
                    </button>
                </form>
            </div>
        </div>
    </NavigationLayout>
</template>

<script setup>
import "iconify-icon";
import { ref, watch, computed } from "vue";
import NavigationLayout from "@/Layouts/NavigationLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { debounce } from "lodash";

// Props
const props = defineProps({
    flashcardSet: {
        type: Object,
        required: true,
    },
});

// Data
const wordSeparator = ref(";");
const customSeparator = ref("");
const separatorType = ref("newline");
const flashcardSetName = ref(props.flashcardSet.name);
const flashcards = ref(
    JSON.parse(JSON.stringify(props.flashcardSet.flashcards))
);
const formattedFlashcards = computed(() => {
    return flashcards.value
        .map(
            (flashcard) =>
                `${flashcard.question} ${wordSeparator.value} ${flashcard.answer}`
        )
        .join("\n");
});
const textInput = ref(formattedFlashcards.value);

// Methods
function addFlashcard() {
    flashcards.value.push({ question: "", answer: "" });
}

function removeFlashcard(index) {
    flashcards.value.splice(index, 1);
}
const processText = debounce(() => {
    // Clear existing flashcards except those created by hand
    flashcards.value.splice(
        0,
        flashcards.value.length,
        ...flashcards.value.filter((f) => f.byHand)
    );
    let currentStep = 0;
    let question = "";
    let answer = "";

    for (let i = 0; i < textInput.value.length; i++) {
        currentStep++;
        if (textInput.value[i] === wordSeparator.value) {
            question = textInput.value.substring(i - currentStep, i);
            currentStep = 0;
        } else if (
            textInput.value[i] === customSeparator.value &&
            separatorType.value === "custom"
        ) {
            answer = textInput.value.substring(
                i - currentStep + wordSeparator.value.length,
                i
            );
            flashcards.value.push({ question, answer });
            currentStep = 0;
        } else if (
            separatorType.value === "newline" &&
            textInput.value[i] === "\n"
        ) {
            answer = textInput.value.substring(
                i - currentStep + wordSeparator.value.length,
                i
            );
            if (
                !flashcards.value.some(
                    (f) => f.question === question && f.answer === answer
                )
            ) {
                flashcards.value.push({ question, answer });
            }
            currentStep = 0;
        }
    }
}, 300);

watch(textInput, processText);
async function updateFlashcardSet() {
    try {
        router.put("/decks/" + props.flashcardSet.id, {
            method: "PUT",
            name: flashcardSetName.value,
            flashcards: flashcards.value,
            textInput: textInput.value,
            wordSeparator: wordSeparator.value,
            customSeparator: customSeparator.value,
            separatorType: separatorType.value,
        });
    } catch (error) {
        console.error("Error updating flashcard set:", error);
        alert(
            "An error occurred while updating the flashcard set. Please try again."
        );
    }
}
</script>
