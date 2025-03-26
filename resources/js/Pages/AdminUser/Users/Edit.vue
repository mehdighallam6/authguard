<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import DashboardAdminLayout from '@/Layouts/DashboardAdminLayout.vue';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select';
import { Separator } from '@/Components/ui/separator';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    user: any;
    roles: any[];
}>();

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: '',
    role: props.user.roles[0]?.name,
});
</script>
<template>
    <Head title="Edit User" />
    <DashboardAdminLayout>
        <div class="p-6 grid md:grid-cols-2 grid-cols-1">
            <div class="w-full">
                <div>
                    <h3 class="text-lg font-medium my-2"> Edit user </h3>
                    <p class="text-sm text-muted-foreground">
                        Edit the user details.
                    </p>
                </div>
                <Separator class="my-5" />
                <form
                    class="space-y-8"
                    @submit.prevent="form.put(route('users.update', user.id))"
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
                    <!--Email-->
                    <div>
                        <label
                            class="block mb-2 ml-1"
                            for="email"
                        >
                            Email
                        </label>

                        <Input
                            id="email"
                            v-model="form.email"
                            type="email"
                            placeholder="Enter your email"
                        />

                        <p
                            v-if="form.errors.email"
                            class="text-sm text-red-500 mt-3"
                        >
                            {{ form.errors.email }}
                        </p>
                    </div>
                    <!--Password-->
                    <div>
                        <label
                            class="block mb-2 ml-1"
                            for="password"
                        >
                            Password
                        </label>
                        <Input
                            id="password"
                            v-model="form.password"
                            type="password"
                            placeholder="Enter your password"
                        />
                        <p
                            v-if="form.errors.password"
                            class="text-sm text-red-500 mt-3"
                        >
                            {{ form.errors.password }}
                        </p>
                    </div>
                    <!--Role-->
                    <div>
                        <label
                            class="block mb-2 ml-1"
                            for="role"
                        >
                            Role
                        </label>
                        <Select v-model="form.role">
                            <SelectTrigger>
                                <SelectValue :placeholder="form.role" />
                            </SelectTrigger>

                            <SelectContent>
                                <SelectGroup>
                                    <SelectItem
                                        v-for="role in roles"
                                        :key="role"
                                        :value="role"
                                        :name="form.role"
                                    >
                                        {{ role }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                        <p
                            v-if="form.errors.role"
                            class="text-sm text-red-500 mt-3"
                        >
                            {{ form.errors.role }}
                        </p>
                    </div>

                    <div class="flex gap-2 justify-end items-center pt-6">
                        <Link
                            as="button"
                            :href="route('users.index')"
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
