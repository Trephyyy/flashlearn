<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";
import NavigationLayout from "@/Layouts/NavigationLayout.vue";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <NavigationLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:bg-dark-800 dark:text-gray-200"
            >
                Profile
            </h2>
        </template>

        <div class="py-12 dark:bg-gray-900">
            <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="p-4 bg-white shadow sm:rounded-lg sm:p-8 dark:bg-gray-800 dark:text-gray-200"
                >
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div
                    class="p-4 bg-white shadow sm:rounded-lg sm:p-8 dark:bg-gray-800 dark:text-gray-200"
                >
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div
                    class="p-4 bg-white shadow sm:rounded-lg sm:p-8 dark:bg-gray-800 dark:text-gray-200"
                >
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </NavigationLayout>
</template>
