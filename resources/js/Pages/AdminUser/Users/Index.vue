<script setup lang="ts">
import DashboardAdminLayout from '@/Layouts/DashboardAdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
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
    CheckIcon,
    File,
    ListFilter,
    MoreHorizontal,
    PlusCircle,
    Search,
} from 'lucide-vue-next';
import {
    Pagination,
    PaginationEllipsis,
    PaginationFirst,
    PaginationLast,
    PaginationList,
    PaginationListItem,
    PaginationNext,
    PaginationPrev,
} from '@/Components/ui/pagination';
import { router } from '@inertiajs/vue3';
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/Components/ui/alert-dialog';
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

defineProps<{
    users: any;
}>();

const handlePageChange = (url: any) => {
    router.get(
        url,
        {},
        {
            preserveState: true,
            preserveScroll: true,
        },
    );
};

const search = ref('');
const selectedRole = ref('');
const currentQuery = usePage<any>().props.ziggy.query;

onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    search.value = urlParams.get('search') || '';
    selectedRole.value = urlParams.get('role') || '';
});

function performSearch(event: any) {
    const { role } = currentQuery;
    if (event.keyCode == 13) {
        router.get('/users', {
            role,
            search: search.value,
        });
    }
}

const filterByRole = (role: any) => {
    selectedRole.value = role;
    const { role: _, ...updatedQuery } = currentQuery;

    if (role) {
        updatedQuery.role = role;
    }

    router.get('/users', updatedQuery);
};
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
                                v-model="search"
                                type="search"
                                placeholder="Search"
                                class="w-full rounded-lg bg-background pl-8 md:w-[200px] lg:w-[320px]"
                                :onkeydown="(e: any) => performSearch(e)"
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
                                    <DropdownMenuItem
                                        class="flex justify-between"
                                        @click="filterByRole('')"
                                    >
                                        None
                                        <CheckIcon v-if="selectedRole == ''" />
                                    </DropdownMenuItem>
                                    <DropdownMenuItem
                                        class="flex justify-between"
                                        @click="filterByRole('admin')"
                                    >
                                        Admin
                                        <CheckIcon
                                            v-if="selectedRole == 'admin'"
                                        />
                                    </DropdownMenuItem>
                                    <DropdownMenuItem
                                        class="flex justify-between"
                                        @click="filterByRole('standard')"
                                        >Standard
                                        <CheckIcon
                                            v-if="selectedRole == 'standard'"
                                        />
                                    </DropdownMenuItem>
                                </DropdownMenuContent>
                            </DropdownMenu>
                            <Link
                                :href="route('users.create')"
                                class="flex justify-center items-center border rounded-md px-3 py-2 text-sm bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 gap-1"
                            >
                                <PlusCircle class="h-3.5 w-3.5" />
                                <span
                                    class="sr-only sm:not-sr-only sm:whitespace-nowrap"
                                >
                                    Add User
                                </span>
                            </Link>
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
                                        <TableHead class="hidden md:table-cell">
                                            Email
                                        </TableHead>
                                        <TableHead>Role</TableHead>
                                        <TableHead class="hidden lg:table-cell">
                                            Tags
                                        </TableHead>
                                        <TableHead class="hidden lg:table-cell">
                                            Authenticators
                                        </TableHead>
                                        <TableHead class="hidden lg:table-cell">
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
                                        <TableCell class="hidden md:table-cell">
                                            {{ user.email }}
                                        </TableCell>
                                        <TableCell>
                                            <Badge variant="outline">
                                                {{
                                                    user.roles[0]?.name || 'N/A'
                                                }}
                                            </Badge>
                                        </TableCell>
                                        <TableCell class="hidden lg:table-cell">
                                            {{ user.tags_count }}
                                        </TableCell>
                                        <TableCell class="hidden lg:table-cell">
                                            {{ user.authenticators_count }}
                                        </TableCell>
                                        <TableCell class="hidden lg:table-cell">
                                            {{
                                                new Date(
                                                    user.created_at,
                                                ).toDateString()
                                            }}
                                        </TableCell>
                                        <TableCell
                                            class="flex justify-end items-center"
                                        >
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
                                                    <DropdownMenuItem
                                                        class="p-0 m-0"
                                                    >
                                                        <Link
                                                            :href="
                                                                route(
                                                                    'users.edit',
                                                                    user.id,
                                                                )
                                                            "
                                                            as="button"
                                                            class="flex justify-start w-full h-full p-1.5 text-sm text-primary font-medium"
                                                        >
                                                            Edit
                                                        </Link>
                                                    </DropdownMenuItem>
                                                    <AlertDialog>
                                                        <AlertDialogTrigger
                                                            as-child
                                                        >
                                                            <Button
                                                                variant="ghost"
                                                                class="flex justify-start w-full h-full p-1.5 text-sm text-primary rounded-sm"
                                                            >
                                                                Delete
                                                            </Button>
                                                        </AlertDialogTrigger>
                                                        <AlertDialogContent>
                                                            <AlertDialogHeader>
                                                                <AlertDialogTitle
                                                                    >Are you
                                                                    absolutely
                                                                    sure?</AlertDialogTitle
                                                                >
                                                                <AlertDialogDescription>
                                                                    This action
                                                                    cannot be
                                                                    undone. This
                                                                    will
                                                                    permanently
                                                                    delete the
                                                                    user and
                                                                    remove your
                                                                    data from
                                                                    our servers.
                                                                </AlertDialogDescription>
                                                            </AlertDialogHeader>
                                                            <AlertDialogFooter>
                                                                <AlertDialogCancel
                                                                    >Cancel</AlertDialogCancel
                                                                >
                                                                <Link
                                                                    :href="
                                                                        route(
                                                                            'users.destroy',
                                                                            user.id,
                                                                        )
                                                                    "
                                                                    method="delete"
                                                                    class="flex justify-center items-center border rounded-md px-4 py-1.5 lg:py-0 h-full text-md bg-primary text-primary-foreground hover:bg-primary/90"
                                                                    >Delete</Link
                                                                >
                                                            </AlertDialogFooter>
                                                        </AlertDialogContent>
                                                    </AlertDialog>
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
                    <div class="flex justify-center">
                        <Pagination
                            v-slot="{ page }"
                            :total="users.total"
                            :sibling-count="1"
                            show-edges
                            :default-page="1"
                            :items-per-page="users.per_page"
                        >
                            <PaginationList
                                v-slot="{ items }"
                                class="flex items-center gap-1"
                            >
                                <PaginationFirst
                                    @click.prevent="
                                        handlePageChange(users.first_page_url)
                                    "
                                />
                                <PaginationPrev
                                    @click.prevent="
                                        handlePageChange(users.prev_page_url)
                                    "
                                />

                                <template v-for="(item, index) in items">
                                    <PaginationListItem
                                        v-if="item.type === 'page'"
                                        :key="index"
                                        :value="item.value"
                                        as-child
                                    >
                                        <Button
                                            @click.prevent="
                                                handlePageChange(
                                                    users.links[item.value].url,
                                                )
                                            "
                                            class="w-10 h-10 p-0"
                                            :variant="
                                                item.value === page
                                                    ? 'default'
                                                    : 'outline'
                                            "
                                        >
                                            {{ item.value }}
                                        </Button>
                                    </PaginationListItem>
                                    <PaginationEllipsis
                                        v-else
                                        :key="item.type"
                                        :index="index"
                                    />
                                </template>

                                <PaginationNext
                                    @click.prevent="
                                        handlePageChange(users.next_page_url)
                                    "
                                />
                                <PaginationLast
                                    @click.prevent="
                                        handlePageChange(users.last_page_url)
                                    "
                                />
                            </PaginationList>
                        </Pagination>
                    </div>
                </main>
            </div>
        </div>
    </DashboardAdminLayout>
</template>
