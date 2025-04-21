<script setup lang="ts">
import DashboardAdminLayout from '@/Layouts/DashboardAdminLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Telescope" />
    <DashboardAdminLayout>
        <iframe
            src="/telescope"
            class="w-full h-full"
        >
        </iframe>
    </DashboardAdminLayout>
</template>
