<template>
    <header class="p-4 text-white bg-blue-500 dark:bg-blue-800">
        <nav class="container flex items-center justify-between mx-auto">
            <Link href="/" class="flex flex-row items-center space-x-2">
                <img src="/flashlearn-logo.png" class="max-h-10" alt="" />
                <div class="text-lg font-bold">FlashLearn</div>
            </Link>
            <ul class="flex space-x-4">
                <li><Link href="/" class="hover:underline">Home</Link></li>
                <li>
                    <Link href="/decks" class="hover:underline"
                        >Flashcards</Link
                    >
                </li>
                <li>
                    <Link href="/decks/create" class="hover:underline"
                        >Create</Link
                    >
                </li>
                <li v-if="!$page.props.auth.user">
                    <Link href="/login" class="hover:underline">Login</Link>
                </li>
                <li v-else>
                    <Link href="/profile" class="hover:underline">
                        {{ $page.props.auth.user.name }}</Link
                    >
                </li>
            </ul>
        </nav>
    </header>
    <slot />
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<style scoped></style>
