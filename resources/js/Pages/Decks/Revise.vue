<script setup>
import { ref, computed } from "vue";
import { Transition } from "vue";
import "iconify-icon";
import NavigationLayout from "@/Layouts/NavigationLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    flashcards: {
        type: Object,
        required: true,
    },
});

const cards = ref([...props.flashcards.flashcards]);
const currentIndex = ref(0);
const history = ref([]);
const learntCards = ref(0);
const showSide = ref(true);
const loadingSide = ref(false);
const isFlipped = ref(false);
const transitionDirection = ref(""); // To track the transition direction

const toggleFlip = () => {
    loadingSide.value = true;
    isFlipped.value = !isFlipped.value;
    setTimeout(() => {
        loadingSide.value = false;
        showSide.value = !showSide.value;
    }, 100);
};

const currentCard = computed(() => cards.value[currentIndex.value]);
const loadNext = ref(false);

const markAsLearnt = () => {
    transitionDirection.value = "right"; // Set transition direction to right
    loadNext.value = true;
    setTimeout(() => {
        learntCards.value++;
        history.value.push(cards.value[currentIndex.value]);
        cards.value.splice(currentIndex.value, 1);

        if (cards.value.length === 0) {
            alert("Congratulations! You've completed all flashcards.");
            return;
        }

        currentIndex.value = Math.min(
            currentIndex.value,
            cards.value.length - 1
        );
        transitionDirection.value = ""; // Reset transition direction
        loadNext.value = false;
    }, 100); // Wait for the transition to complete
};

const markAsUnlearnt = () => {
    transitionDirection.value = "left"; // Set transition direction to left
    loadNext.value = true;
    setTimeout(() => {
        history.value.push(cards.value[currentIndex.value]);
        const card = cards.value.splice(currentIndex.value, 1)[0];
        cards.value.push(card);

        if (cards.value.length === 0) {
            alert("Congratulations! You've completed all flashcards.");
            return;
        }

        currentIndex.value = Math.min(
            currentIndex.value,
            cards.value.length - 1
        );
        transitionDirection.value = ""; // Reset transition direction
    }, 100); // Wait for the transition to complete
};
</script>

<template>
    <NavigationLayout>
        <div class="relative w-screen min-h-screen dark:bg-slate-800">
            <h1 class="py-4 text-2xl font-bold text-center text-gray-200">
                {{ props.flashcards.name }}
            </h1>
            <div class="flex flex-col items-center w-screen h-full">
                <div class="flex flex-col z-20 items-center w-[600px] h-fit">
                    <Transition
                        :name="transitionDirection"
                        v-show="!transitionDirection"
                        mode="out-in"
                    >
                        <div
                            v-if="currentCard"
                            :key="currentCard.id"
                            class="relative card w-[600px] dark:bg-gray-900 bg-gray-300 p-4 rounded-md h-[400px]"
                            :class="{ flipped: isFlipped }"
                            @click="toggleFlip"
                        >
                            <Transition v-show="!loadingSide" name="fade">
                                <div class="absolute inset-0 flip-container">
                                    <div v-show="showSide" class="front face">
                                        <div
                                            class="flex flex-col items-center justify-center w-full h-full"
                                        >
                                            <div
                                                class="text-2xl text-center dark:text-white"
                                            >
                                                {{ currentCard.question }}
                                            </div>
                                        </div>
                                    </div>
                                    <div v-show="!showSide" class="back face">
                                        <div
                                            class="flex flex-col items-center justify-center w-full h-full"
                                        >
                                            <div
                                                class="text-2xl dark:text-white"
                                                style="
                                                    transform: rotateX(180deg);
                                                "
                                            >
                                                {{ currentCard.answer }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </Transition>
                        </div>
                    </Transition>
                    <div
                        class="absolute grid items-center grid-cols-3 mt-4 top-[480px]"
                    >
                        <div></div>
                        <div>
                            <button
                                @click="markAsUnlearnt"
                                class="px-4 py-2 text-red-500 border border-red-500 rounded hover:bg-red-800"
                            >
                                <iconify-icon icon="mdi:no-entry" />
                            </button>
                            <span class="px-4 dark:text-white">
                                {{
                                    props.flashcards.flashcards.length -
                                    cards.length
                                }}
                                /
                                {{ props.flashcards.flashcards.length }}
                            </span>
                            <button
                                @click="markAsLearnt"
                                class="px-4 py-2 text-green-500 border border-green-500 rounded hover:bg-green-800"
                            >
                                <iconify-icon icon="mdi:check" />
                            </button>
                        </div>
                        <Link
                            class="absolute z-10 px-4 py-2 border-2 rounded-lg dark:text-white"
                            :href="'/flashcards/' + currentCard.id + '/edit'"
                            ><button>
                                <iconify-icon icon="mdi:edit" /></button
                        ></Link>
                    </div>
                </div>
            </div>
        </div>
    </NavigationLayout>
</template>

<style scoped>
.card {
    perspective: 1000px;
    transition: transform 0.2s;
}

.flip-container {
    transition: transform 0.8s;
    transform-style: preserve-3d;
}

.flipped {
    transform: rotateX(180deg);
}

.face {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.1s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Transition for moving left */
.left-enter-active,
.left-leave-active {
    transition: all 0.1s ease;
}

.left-enter-from {
    opacity: 0;
    transform: rotate(-0.05turn) translateX(-50%);
}

.left-leave-to {
    opacity: 0;
    transform: rotate(-0.05turn) translateX(-50%);
}

/* Transition for moving right */
.right-enter-active,
.right-leave-active {
    transition: all 0.2s ease;
}

.right-enter-from {
    opacity: 0;
    transform: rotate(0.05turn) translateX(50%);
}

.right-leave-to {
    opacity: 0;
    transform: rotate(0.05turn) translateX(50%);
}
</style>
