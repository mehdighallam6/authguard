<script setup lang="ts">
import DashboardAdminLayout from '@/Layouts/DashboardAdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Badge } from '@/Components/ui/badge';
import { Button } from '@/Components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import { Input } from '@/Components/ui/input';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table';
import {
    File,
    ListFilter,
    MoreHorizontal,
    PlusCircle,
    Search,
} from 'lucide-vue-next';

defineProps<{
    users: any;
}>();
</script>

<template>
    <Head title="Users" />

    <DashboardAdminLayout>
        <div class="flex min-h-screen w-full flex-col bg-muted/40">
            <div class="flex flex-col sm:gap-4 sm:py-4 sm:pl-14">
                <main
                    class="grid flex-1 items-start gap-4 p-4 sm:px-6 sm:py-0 md:gap-8"
                >
                    <div class="flex items-center gap-2">
                        <div class="relative flex-1 md:grow-0">
                            <Search
                                class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground"
                            />
                            <Input
                                type="search"
                                placeholder="Search..."
                                class="w-full rounded-lg bg-background pl-8 md:w-[200px] lg:w-[320px]"
                            />
                        </div>
                        <div class="ml-auto flex items-center gap-2">
                            <DropdownMenu>
                                <DropdownMenuTrigger as-child>
                                    <Button
                                        variant="outline"
                                        size="sm"
                                        class="h-9 gap-1"
                                    >
                                        <ListFilter class="h-3.5 w-3.5" />
                                        <span
                                            class="sr-only sm:not-sr-only sm:whitespace-nowrap"
                                        >
                                            Filter
                                        </span>
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent align="end">
                                    <DropdownMenuLabel
                                        >Filter by</DropdownMenuLabel
                                    >
                                    <DropdownMenuSeparator />
                                    <DropdownMenuItem checked>
                                        Active
                                    </DropdownMenuItem>
                                    <DropdownMenuItem>Draft</DropdownMenuItem>
                                    <DropdownMenuItem>
                                        Archived
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                            <Button
                                size="sm"
                                class="h-9 gap-1"
                            >
                                <PlusCircle class="h-3.5 w-3.5" />
                                <span
                                    class="sr-only sm:not-sr-only sm:whitespace-nowrap"
                                >
                                    Add User
                                </span>
                            </Button>
                        </div>
                    </div>

                    <Card>
                        <CardHeader>
                            <CardTitle>Users</CardTitle>
                            <CardDescription>
                                Manage your users and view their roles.
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead
                                            class="hidden w-[100px] sm:table-cell"
                                        >
                                            <span class="sr-only">img</span>
                                        </TableHead>
                                        <TableHead>Name</TableHead>
                                        <TableHead>Role</TableHead>
                                        <TableHead class="hidden md:table-cell">
                                            Created at
                                        </TableHead>
                                        <TableHead>
                                            <span class="sr-only">Actions</span>
                                        </TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    <TableRow
                                        v-for="user in users.data"
                                        :key="user.id"
                                    >
                                        <TableCell class="hidden sm:table-cell">
                                            {{ user.id }}
                                        </TableCell>
                                        <TableCell class="font-medium">
                                            {{ user.name }}
                                        </TableCell>
                                        <TableCell>
                                            <Badge variant="outline">
                                                Role
                                            </Badge>
                                        </TableCell>
                                        <TableCell class="hidden md:table-cell">
                                            {{
                                                new Date(
                                                    user.created_at,
                                                ).toDateString()
                                            }}
                                        </TableCell>
                                        <TableCell>
                                            <DropdownMenu>
                                                <DropdownMenuTrigger as-child>
                                                    <Button
                                                        aria-haspopup="true"
                                                        size="icon"
                                                        variant="ghost"
                                                    >
                                                        <MoreHorizontal
                                                            class="h-4 w-4"
                                                        />
                                                        <span class="sr-only"
                                                            >Toggle menu</span
                                                        >
                                                    </Button>
                                                </DropdownMenuTrigger>
                                                <DropdownMenuContent
                                                    align="end"
                                                >
                                                    <DropdownMenuLabel
                                                        >Actions</DropdownMenuLabel
                                                    >
                                                    <DropdownMenuItem
                                                        >Edit</DropdownMenuItem
                                                    >
                                                    <DropdownMenuItem
                                                        >Delete</DropdownMenuItem
                                                    >
                                                </DropdownMenuContent>
                                            </DropdownMenu>
                                        </TableCell>
                                    </TableRow>
                                </TableBody>
                            </Table>
                        </CardContent>
                        <CardFooter>
                            <div class="text-xs text-muted-foreground">
                                Showing
                                <strong>{{ users.from }}-{{ users.to }}</strong>
                                of
                                <strong>{{ users.total }}</strong>
                                users
                            </div>
                        </CardFooter>
                    </Card>
                </main>
            </div>
        </div>
    </DashboardAdminLayout>
</template>
