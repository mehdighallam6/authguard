<script setup lang="ts">
import { Button } from '@/Components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import { Sheet, SheetContent, SheetTrigger } from '@/Components/ui/sheet';
import { CircleUser, Menu, Package2, Tag, Key } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import { useColorMode } from '@vueuse/core';
import ModeToggle from '@/Components/ModeToggle.vue';

const navigation = [
    {
        name: 'Tags',
        href: route('stags.index'),
        icon: Tag,
        current: '/stags',
    },
    {
        name: 'Authenticators',
        href: route('sauthenticators.index'),
        icon: Key,
        current: '/sauthenticators',
    },
];

var pathname = window.location.pathname;

const mode = useColorMode();
</script>

<template>
    <div
        class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]"
    >
        <div class="hidden border-r bg-muted/40 md:block">
            <div class="flex h-full max-h-screen flex-col gap-2">
                <div
                    class="flex h-14 items-center justify-between border-b px-4 lg:h-[60px] lg:px-6"
                >
                    <a
                        href="/"
                        class="flex items-center gap-2 font-semibold"
                    >
                        <Package2 class="h-6 w-6" />
                        <span class="">AuthGuard</span>
                    </a>
                    <ModeToggle />
                </div>
                <div class="flex-1">
                    <nav
                        class="grid items-start px-2 text-sm font-medium lg:px-4"
                    >
                        <Link
                            v-for="item in navigation"
                            :href="item.href"
                            :class="[
                                item.current == pathname
                                    ? 'bg-muted text-primary'
                                    : 'text-muted-foreground',
                                'flex items-center gap-3 rounded-lg px-3 py-2 transition-all hover:text-primary',
                            ]"
                        >
                            <component
                                :is="item.icon"
                                class="h-4 w-4"
                            />
                            {{ item.name }}
                        </Link>
                    </nav>
                </div>
            </div>
        </div>
        <div class="flex flex-col h-screen overflow-hidden">
            <header
                class="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6"
            >
                <Sheet>
                    <SheetTrigger as-child>
                        <Button
                            variant="outline"
                            size="icon"
                            class="shrink-0 md:hidden"
                        >
                            <Menu class="h-5 w-5" />
                            <span class="sr-only">Toggle navigation menu</span>
                        </Button>
                    </SheetTrigger>
                    <SheetContent
                        side="left"
                        class="flex flex-col"
                    >
                        <nav class="grid gap-2 text-lg font-medium">
                            <div
                                class="flex justify-evenly items-center px-4 py-2"
                            >
                                <a
                                    href="#"
                                    class="flex items-center gap-2 text-lg font-semibold"
                                >
                                    <Package2 class="h-6 w-6" />
                                    <span class="sr-only">AuthGuard</span>
                                </a>
                                <ModeToggle />
                            </div>
                            <Link
                                v-for="item in navigation"
                                :href="item.href"
                                :class="[
                                    item.current == pathname
                                        ? 'bg-muted text-foreground'
                                        : 'text-muted-foreground',
                                    'mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 hover:text-foreground',
                                ]"
                            >
                                <component
                                    :is="item.icon"
                                    class="h-5 w-5"
                                />
                                {{ item.name }}
                            </Link>
                        </nav>
                    </SheetContent>
                </Sheet>
                <div class="w-full flex-1">
                    <!--for search input-->
                </div>
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button
                            variant="secondary"
                            size="icon"
                            class="rounded-full"
                        >
                            <CircleUser class="h-5 w-5" />
                            <span class="sr-only">Toggle user menu</span>
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuItem>
                            <Link
                                :href="route('profile.edit')"
                                as="button"
                                class="w-full h-full flex items-center"
                            >
                                Profile
                            </Link>
                        </DropdownMenuItem>
                        <DropdownMenuSeparator />
                        <DropdownMenuItem>
                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                class="w-full h-full flex items-center"
                            >
                                Logout
                            </Link>
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </header>
            <main class="flex-1 overflow-y-auto">
                <slot />
            </main>
        </div>
    </div>
</template>
