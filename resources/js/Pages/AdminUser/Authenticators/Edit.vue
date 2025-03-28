<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Separator } from '@/Components/ui/separator';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select';
import { ref, watch } from 'vue';
import DashboardAdminLayout from '@/Layouts/DashboardAdminLayout.vue';

const props = defineProps<{
    authenticator: any;
    tags: any;
}>();

const selectedTag = ref(
    props.tags.find((tag: any) => tag.id === props.authenticator.tag_id) ||
        props.tags[0],
);

const form = useForm({
    name: props.authenticator.name,
    key: '',
    tag_id: selectedTag.value.id,
});

watch(selectedTag, (newTag) => {
    console.log(newTag);
    selectedTag.value = newTag;
});
</script>
<template>
    <Head title="Edit authenticator" />
    <DashboardAdminLayout>
        <div class="p-6 grid md:grid-cols-2 grid-cols-1">
            <div class="w-full">
                <div>
                    <h3 class="text-lg font-medium my-2">
                        Edit authenticator
                    </h3>
                    <p class="text-sm text-muted-foreground">
                        Edit an authenticator in your organization.
                    </p>
                </div>
                <Separator class="my-5" />
                <form
                    class="space-y-8"
                    @submit.prevent="
                        form.put(
                            route('aauthenticators.update', authenticator.id),
                        )
                    "
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

                    <!--Key-->
                    <div>
                        <label
                            class="block mb-2 ml-1"
                            for="key"
                        >
                            Key
                        </label>

                        <Input
                            id="key"
                            v-model="form.key"
                            type="text"
                            placeholder="Enter the key"
                        />

                        <p
                            v-if="form.errors.key"
                            class="text-sm text-red-500 mt-3"
                        >
                            {{ form.errors.key }}
                        </p>
                    </div>

                    <!--Tags-->
                    <div>
                        <label
                            class="block mb-2 ml-1"
                            for="role"
                        >
                            Tags
                            <span v-if="tags[1].user">
                                ( showing only tags of {{ tags[1].user.name }} )
                            </span>
                        </label>
                        <Select
                            v-model="form.tag_id"
                            as-child
                        >
                            <SelectTrigger>
                                <SelectValue />
                            </SelectTrigger>

                            <SelectContent>
                                <SelectGroup>
                                    <SelectItem
                                        v-for="tag in tags"
                                        :key="tag.name"
                                        :value="tag.id"
                                    >
                                        {{ tag.name }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                        <p
                            v-if="form.errors.tag_id"
                            class="text-sm text-red-500 mt-3"
                        >
                            {{ form.errors.tag_id }}
                        </p>
                    </div>

                    <div class="flex gap-2 justify-end items-center pt-6">
                        <Link
                            as="button"
                            :href="route('aauthenticators.index')"
                            class="border border-gray-100/2 rounded-md text-sm px-4 py-2"
                        >
                            Cancel
                        </Link>
                        <Button type="submit"> Save </Button>
                    </div>
                </form>
            </div>
        </div>
    </DashboardAdminLayout>
</template>
