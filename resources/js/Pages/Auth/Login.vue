<script setup lang="ts">
import ModeToggle from '@/Components/ModeToggle.vue';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
//import { Checkbox } from '@/Components/ui/checkbox';
import { Head, Link, useForm } from '@inertiajs/vue3';

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
</script>
<template>
    <div
        class="w-full h-screen lg:grid lg:min-h-[600px] lg:grid-cols-2 xl:min-h-[800px]"
    >
        <Head title="Log in" />
        <div class="h-full flex items-center justify-center py-12">
            <div class="mx-auto grid w-[350px] gap-6">
                <div class="flex items-center justify-center">
                    <ModeToggle />
                </div>
                <div class="grid gap-2 text-center">
                    <h1 class="text-3xl font-bold"> Login </h1>
                    <p class="text-balance text-muted-foreground">
                        Enter your email below to login to your account
                    </p>
                </div>
                <div
                    v-if="status"
                    class="mb-4 text-sm font-medium text-green-600 flex items-center justify-center"
                >
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label
                                for="email"
                                value="Email"
                            >
                                Email
                            </Label>
                            <Input
                                id="email"
                                type="email"
                                placeholder="m@example.com"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>
                        <div class="grid gap-2">
                            <div class="flex items-center">
                                <Label
                                    for="password"
                                    value="Password"
                                >
                                    Password
                                </Label>
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="ml-auto inline-block text-sm underline"
                                >
                                    Forgot your password?
                                </Link>
                            </div>
                            <Input
                                id="password"
                                type="password"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                        </div>
                        <div>
                            <!--<label class="flex items-center">
                                <Checkbox
                                    name="remember"
                                    v-model:checked="form.remember"
                                />
                                <span class="ms-2 text-sm"> Remember me </span>
                            </label>-->
                        </div>
                        <Button
                            type="submit"
                            :class="{ 'opacity-25 w-full': form.processing }"
                            :disabled="form.processing"
                        >
                            Login
                        </Button>
                    </div>
                </form>
                <div class="mt-4 text-center text-sm">
                    Don't have an account?
                    <Link
                        :href="route('register')"
                        class="underline"
                    >
                        Sign up
                    </Link>
                </div>
            </div>
        </div>
        <div class="hidden bg-muted lg:block">
            <img
                src="/placeholder.svg"
                alt="Image"
                width="1920"
                height="1080"
                class="h-full w-full object-cover dark:brightness-[0.2] dark:grayscale"
            />
        </div>
    </div>
</template>
