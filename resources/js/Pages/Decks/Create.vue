<template>
    <Head title="Create Flashcard Set" />
    <NavigationLayout>
        <div
            class="flex items-center justify-center w-screen min-h-[100vh] bg-white dark:bg-slate-900"
        >
            <div
                class="container max-w-lg p-6 mx-auto space-y-4 bg-white shadow-md dark:bg-gray-800 create-flashcard-set rounded-xl"
            >
                <h1
                    class="text-2xl font-bold dark:border-gray-700 dark:text-gray-200"
                >
                    Create Flashcard Set
                </h1>
                <form @submit.prevent="submitForm" class="space-y-4">
                    <div class="form-group">
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                            >Name</label
                        >
                        <input
                            id="name"
                            v-model="name"
                            type="text"
                            class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:text-gray-200 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        />
                    </div>
                    <div class="form-group">
                        <label
                            for="text"
                            class="block text-sm font-medium text-gray-700 dark:border-gray-700 dark:text-gray-200"
                        >
                            Text</label
                        >
                        <!--  <div
                            class="flex flex-row items-center my-2 space-x-3 dark:text-white"
                        >
                            <h4>
                                Does your text use quotes to seperate words?
                            </h4>
                            <input
                                type="checkbox"
                                class="text-indigo-600 rounded dark:bg-gray-900 focus:ring-transparent focus:border-transparent sm:text-sm"
                                v-model="useQuotes"
                            />
                        </div> -->

                        <textarea
                            id="text"
                            v-model="text"
                            placeholder="Paste your text here"
                            class="block w-full h-40 p-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:text-gray-200 dark:border-gray-700 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        ></textarea>
                        <div class="flex flex-row my-4 space-x-8">
                            <div class="flex flex-col dark:text-gray-200">
                                <label for="">Word separator</label>
                                <input
                                    class="rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    type="text"
                                    v-model="wordSeparator"
                                />
                            </div>
                            <div class="flex flex-row space-x-4">
                                <div class="flex flex-col dark:text-white">
                                    <label for="separatorType"
                                        >Card Separator</label
                                    >
                                    <select
                                        id="separatorType"
                                        v-model="separatorType"
                                        class="rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    >
                                        <option value="newline">
                                            New Line
                                        </option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                                <div
                                    class="flex flex-col"
                                    v-if="separatorType === 'custom'"
                                >
                                    <label for="customSeparator"
                                        >Custom Separator</label
                                    >
                                    <input
                                        id="customSeparator"
                                        class="rounded-md shadow-sm dark:border-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        type="text"
                                        v-model="customSeparator"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--    <div class="form-group">
                    <label
                        for="file"
                        class="block text-sm font-medium text-gray-700"
                        >Upload JSON/CSV</label
                    >
                    <input
                        type="file"
                        id="file"
                        @change="handleFileUpload"
                        class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
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
                            class="flex gap-4 mb-2 flashcard"
                        >
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
                            <button
                                type="button"
                                @click="removeFlashcard(index)"
                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            >
                                Remove
                            </button>
                        </div>
                        <button
                            type="button"
                            @click="addFlashcard"
                            class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium text-gray-700 bg-indigo-600 border border-transparent rounded-md shadow-sm dark:text-gray-200 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Add Flashcard
                        </button>
                    </div>
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-green-500 border border-transparent rounded-md shadow-sm dark:bg-green-600 dark:text-gray-200 hover:bg-green-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    >
                        Create Flashcard Set
                    </button>
                </form>
            </div>
        </div>
    </NavigationLayout>
</template>

<script setup>
import { ref, reactive, watch } from "vue";
import { Head, router } from "@inertiajs/vue3";
import NavigationLayout from "@/Layouts/NavigationLayout.vue";

const name = ref("");
const text = ref("");
const file = ref(null);
const wordSeparator = ref(";");
const customSeparator = ref("");
const useQuotes = ref(false);
const separatorType = ref("newline");
const flashcards = reactive([{ question: "", answer: "", byHand: false }]);

import { debounce } from "lodash";

const processText = debounce(() => {
    // Clear existing flashcards except those created by hand
    flashcards.splice(
        0,
        flashcards.length,
        ...flashcards.filter((f) => f.byHand)
    );
    let currentStep = 0;
    let question = "";
    let answer = "";

    for (let i = 0; i < text.value.length; i++) {
        currentStep++;
        if (text.value[i] === wordSeparator.value) {
            question = text.value.substring(i - currentStep, i);
            currentStep = 0;
        } else if (
            text.value[i] === customSeparator.value &&
            separatorType.value === "custom"
        ) {
            answer = text.value.substring(
                i - currentStep + wordSeparator.value.length,
                i
            );
            flashcards.push({ question, answer });
            currentStep = 0;
        } else if (
            separatorType.value === "newline" &&
            text.value[i] === "\n"
        ) {
            answer = text.value.substring(
                i - currentStep + wordSeparator.value.length,
                i
            );
            if (
                !flashcards.some(
                    (f) => f.question === question && f.answer === answer
                )
            ) {
                flashcards.push({ question, answer });
            }
            currentStep = 0;
        }
    }
}, 300);

watch(text, processText);
function handleFileUpload(event) {
    file.value = event.target.files[0];
}

function addFlashcard() {
    flashcards.push({ question: "", answer: "", byHand: true });
}

function removeFlashcard(index) {
    flashcards.splice(index, 1);
}

function submitForm() {
    console.log("Text:", text.value);
    console.log("File:", file.value);
    console.log("Flashcards:", flashcards);
    router.post("/decks", {
        name: name.value,
        flashcards: flashcards,
    });
}
</script>
