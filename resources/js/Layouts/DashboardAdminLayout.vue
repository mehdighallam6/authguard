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
import {
    CircleUser,
    Home,
    Menu,
    Package2,
    Users,
    Tag,
    Key,
} from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';

const navigation = [
    {
        name: 'Dashboard',
        href: route('dashboard'),
        icon: Home,
        current: '/dashboard',
    },
    {
        name: 'Users',
        href: route('users.index'),
        icon: Users,
        current: '/users',
    },
    {
        name: 'Tags',
        href: '',
        icon: Tag,
        current: '/phones',
    },
    {
        name: 'Authenticators',
        href: '',
        icon: Key,
        current: '/authenticators',
    },
];

var pathname = window.location.pathname;
</script>

<template>
    <div
        class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]"
    >
        <div class="hidden border-r bg-muted/40 md:block">
            <div class="flex h-full max-h-screen flex-col gap-2">
                <div
                    class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6"
                >
                    <a
                        href="/"
                        class="flex items-center gap-2 font-semibold"
                    >
                        <Package2 class="h-6 w-6" />
                        <span class="">AuthGuard</span>
                    </a>
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
        <div class="flex flex-col">
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
                            <a
                                href="#"
                                class="flex items-center gap-2 text-lg font-semibold"
                            >
                                <Package2 class="h-6 w-6" />
                                <span class="sr-only">AuthGuard</span>
                            </a>
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
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
