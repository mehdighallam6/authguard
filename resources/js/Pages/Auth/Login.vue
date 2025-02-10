<script setup lang="ts">
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import { Icon } from '@iconify/vue';
import { useColorMode } from '@vueuse/core';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};

const mode = useColorMode();
</script>

<template>
    <Head title="Login" />
    <div class="md:hidden">
        <VPImage
            alt="Authentication"
            width="1280"
            height="1214"
            class="block"
            :image="{
                dark: '/examples/authentication-dark.png',
                light: '/examples/authentication-light.png',
            }"
        />
    </div>

    <div
        class="container relative hidden h-screen flex-col items-center justify-center md:grid lg:max-w-none lg:grid-cols-2 lg:px-0"
    >
        <DropdownMenu>
            <DropdownMenuTrigger as-child>
                <Button
                    variant="ghost"
                    class="absolute right-4 top-4 md:right-8 md:top-8"
                >
                    <Icon
                        icon="radix-icons:moon"
                        class="h-[1.2rem] w-[1.2rem] rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0"
                    />
                    <Icon
                        icon="radix-icons:sun"
                        class="absolute h-[1.2rem] w-[1.2rem] rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100"
                    />
                    <span class="sr-only">Toggle theme</span>
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end">
                <DropdownMenuItem @click="mode = 'light'">
                    Light
                </DropdownMenuItem>
                <DropdownMenuItem @click="mode = 'dark'">
                    Dark
                </DropdownMenuItem>
                <DropdownMenuItem @click="mode = 'auto'">
                    System
                </DropdownMenuItem>
            </DropdownMenuContent>
        </DropdownMenu>
        <div
            class="relative hidden h-full flex-col bg-muted p-10 text-white dark:border-r lg:flex"
        >
            <div class="absolute inset-0 bg-zinc-900" />
            <div class="relative z-20 flex items-center text-lg font-medium">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    class="mr-2 h-6 w-6"
                >
                    <path
                        d="M15 6v12a3 3 0 1 0 3-3H6a3 3 0 1 0 3 3V6a3 3 0 1 0-3 3h12a3 3 0 1 0-3-3"
                    />
                </svg>
                AuthGuard
            </div>
            <div class="relative z-20 mt-auto">
                <blockquote class="space-y-2">
                    <p class="text-lg">
                        &ldquo;This library has saved me countless hours of work
                        and helped me deliver stunning designs to my clients
                        faster than ever before.&rdquo;
                    </p>
                    <footer class="text-sm"> Sofia Davis </footer>
                </blockquote>
            </div>
        </div>
        <div class="lg:p-8">
            <div
                class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]"
            >
                <div class="flex flex-col space-y-2 text-center">
                    <h1 class="text-2xl font-semibold tracking-tight">
                        Sign In
                    </h1>
                    <p class="text-sm text-muted-foreground">
                        Enter your email below to sign in
                    </p>
                </div>
                <div class="grid gap-2">
                    <form @submit.prevent="submit">
                        <div class="grid gap-1">
                            <Label
                                class="sr-only"
                                for="email"
                            >
                                Email
                            </Label>
                            <Input
                                id="email"
                                placeholder="email"
                                type="email"
                                auto-capitalize="none"
                                auto-complete="email"
                                auto-correct="off"
                                class="my-2"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <Label
                                class="sr-only"
                                for="password"
                            >
                                Password
                            </Label>
                            <Input
                                id="password"
                                placeholder="password"
                                type="password"
                                class="my-2"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                            <label class="flex items-center">
                                <Checkbox
                                    name="remember"
                                    v-model:checked="form.remember"
                                />
                                <span class="ms-2 text-sm">Remember me</span>
                            </label>
                        </div>
                        <Button
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            class="mt-5 w-full"
                        >
                            Sign In
                        </Button>
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="block mt-5 rounded-md text-sm underline focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Forgot your password?
                        </Link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
