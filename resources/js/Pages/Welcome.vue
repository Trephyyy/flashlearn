<script setup>
import { Head, Link, router } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Home" />
    <div>
        <div
            class="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-slate-900"
        >
            <h1 class="text-4xl font-bold dark:text-white">
                Welcome to FlashLearn
            </h1>
            <p
                class="max-w-xl mb-8 text-lg text-center text-gray-700 dark:text-gray-300"
            >
                FlashLearn is a simple flashcard app to help you study and learn
                new things.
            </p>
            <div class="flex space-x-4">
                <Link
                    href="/decks"
                    class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700"
                >
                    View Flashcards
                </Link>
                <Link
                    href="/decks/create"
                    class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700"
                >
                    Create Flashcards
                </Link>
            </div>
            <!--   <div class="mt-8">
                <p class="text-gray-600">
                    Laravel Version: {{ laravelVersion }}
                </p>
                <p class="text-gray-600">PHP Version: {{ phpVersion }}</p>
            </div> -->
            <div class="mt-4 text-center" v-if="!$page.props.auth.user">
                <p v-if="canLogin" class="text-gray-600">
                    <Link href="/login" class="text-blue-500 hover:underline"
                        >Login</Link
                    >
                </p>
                <p v-if="canRegister" class="text-gray-600">
                    <Link href="/register" class="text-blue-500 hover:underline"
                        >Register</Link
                    >
                </p>
            </div>
            <div class="mt-4 text-center text-red-500 dark:text-red-400" v-else>
                <Link @click="router.post('/logout')">Log out</Link>
            </div>
        </div>
    </div>
</template>
