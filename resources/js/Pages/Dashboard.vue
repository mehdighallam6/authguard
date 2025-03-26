<script setup lang="ts">
import DashboardAdminLayout from '@/Layouts/DashboardAdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card';
import { KeyIcon, TagsIcon, UsersIcon } from 'lucide-vue-next';

defineProps<{
    stats: any;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <DashboardAdminLayout>
        <div class="p-4">
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                <Card>
                    <CardHeader
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <CardTitle class="text-sm font-medium">
                            Users
                        </CardTitle>
                        <UsersIcon class="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ stats.users_count }}
                        </div>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <CardTitle class="text-sm font-medium">
                            Tags
                        </CardTitle>
                        <TagsIcon class="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ stats.tags_count }}
                        </div>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader
                        class="flex flex-row items-center justify-between space-y-0 pb-2"
                    >
                        <CardTitle class="text-sm font-medium">
                            Authenticators
                        </CardTitle>
                        <KeyIcon class="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ stats.authenticators_count }}
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </DashboardAdminLayout>
</template>
