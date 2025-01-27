<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import DashboardAdminLayout from '@/Layouts/DashboardAdminLayout.vue';

defineProps<{
    roles: any;
}>();
</script>
<template>
    <Head title="Create User" />
    <DashboardAdminLayout>
        <div>Create User</div>
        <div>{{ roles }}</div>
    </DashboardAdminLayout>
</template>
