<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import DashboardStandardLayout from '@/Layouts/DashboardStandardLayout.vue';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Separator } from '@/Components/ui/separator';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    tag: any;
}>();

const form = useForm({
    name: props.tag.name,
});
</script>
<template>
    <Head title="Edit Tag" />
    <DashboardStandardLayout>
        <div class="p-6 grid md:grid-cols-2 grid-cols-1">
            <div class="w-full">
                <div>
                    <h3 class="text-lg font-medium my-2"> Edit tag </h3>
                    <p class="text-sm text-muted-foreground">
                        Edit the tag details.
                    </p>
                </div>
                <Separator class="my-5" />
                <form
                    class="space-y-8"
                    @submit.prevent="form.put(route('stags.update', tag.id))"
                >
                    <!--Name-->
                    <div>
                        <label
                            class="block mb-2 ml-1"
                            for="name"
                        >
                            Name
                        </label>

                        <Input
                            id="name"
                            v-model="form.name"
                            type="text"
                            placeholder="Enter your name"
                        />

                        <p
                            v-if="form.errors.name"
                            class="text-sm text-red-500 mt-3"
                        >
                            {{ form.errors.name }}
                        </p>
                    </div>

                    <div class="flex gap-2 justify-end items-center pt-6">
                        <Link
                            as="button"
                            :href="route('stags.index')"
                            class="border border-gray-100/2 rounded-md text-sm px-4 py-2"
                        >
                            Cancel
                        </Link>
                        <Button type="submit"> Save </Button>
                    </div>
                </form>
            </div>
        </div>
    </DashboardStandardLayout>
</template>
