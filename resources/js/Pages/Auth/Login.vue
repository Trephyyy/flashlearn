<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>
        <div class="mb-4">
            <h2
                class="mt-2 text-2xl font-semibold text-center text-black dark:text-white"
            >
                Login
            </h2>
            <Link
                href="/register"
                class="text-sm text-center text-gray-400 underline"
                ><p class="italic">Create an account</p></Link
            >
        </div>
        <form @submit.prevent="submit">
            <div>
                <InputLabel
                    for="email"
                    class="dark:text-gray-100"
                    value="Email"
                />

                <TextInput
                    id="email"
                    type="email"
                    class="block w-full mt-1 dark:bg-gray-950 dark:border-gray-600 dark:text-white"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel
                    class="dark:text-gray-100"
                    for="password"
                    value="Password"
                />

                <TextInput
                    id="password"
                    type="password"
                    class="block w-full mt-1 dark:bg-gray-950 dark:border-gray-600 dark:text-white"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox
                        class="border-gray-600 dark:bg-gray-900"
                        name="remember"
                        v-model:checked="form.remember"
                    />
                    <span class="text-sm text-gray-600 dark:text-gray-400 ms-2"
                        >Remember me</span
                    >
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="text-sm text-gray-600 underline rounded-md dark:text-gray-300 dark:hover:text-gray-600 dark:text-gray-400 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
