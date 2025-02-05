<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
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
import { MoreHorizontal, PlusCircle, Search } from 'lucide-vue-next';
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
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/Components/ui/alert-dialog';
import { ref, onMounted } from 'vue';
import DashboardStandardLayout from '@/Layouts/DashboardStandardLayout.vue';

defineProps<{
    authenticators: any;
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

onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    search.value = urlParams.get('search') || '';
});

function performSearch(event: any) {
    if (event.keyCode == 13) {
        router.get('/sauthenticators', {
            search: search.value,
        });
    }
}
</script>

<template>
    <Head title="Authenticators" />

    <DashboardStandardLayout>
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
                                placeholder="Enter an name"
                                class="w-full rounded-lg bg-background pl-8 md:w-[200px] lg:w-[320px]"
                                :onkeydown="(e: any) => performSearch(e)"
                            />
                        </div>
                        <div class="ml-auto flex items-center gap-2">
                            <Link
                                :href="route('sauthenticators.create')"
                                class="flex justify-center items-center border rounded-md px-3 py-2 text-sm bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 gap-1"
                            >
                                <PlusCircle class="h-3.5 w-3.5" />
                                <span
                                    class="sr-only sm:not-sr-only sm:whitespace-nowrap"
                                >
                                    Add Tag
                                </span>
                            </Link>
                        </div>
                    </div>

                    <Card>
                        <CardHeader>
                            <CardTitle>Authenticators</CardTitle>
                            <CardDescription>
                                Manage authenticators and view their tags.
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
                                        <TableHead>OTP</TableHead>
                                        <TableHead class="hidden md:table-cell">
                                            Tag
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
                                        v-for="authenticator in authenticators.data"
                                        :key="authenticator.id"
                                    >
                                        <TableCell class="hidden sm:table-cell">
                                            {{ authenticator.id }}
                                        </TableCell>
                                        <TableCell class="font-medium">
                                            {{ authenticator.name }}
                                        </TableCell>
                                        <TableCell class="font-medium">
                                            {{ authenticator.otp }}
                                        </TableCell>
                                        <TableCell class="hidden md:table-cell">
                                            {{
                                                authenticator.tag?.name || 'N/A'
                                            }}
                                        </TableCell>

                                        <TableCell class="hidden lg:table-cell">
                                            {{
                                                new Date(
                                                    authenticator.created_at,
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
                                                    <DropdownMenuItem
                                                        class="p-0 m-0"
                                                    >
                                                        <Link
                                                            :href="
                                                                route(
                                                                    'sauthenticators.edit',
                                                                    authenticator.id,
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
                                                                    tag and
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
                                                                            'sauthenticators.destroy',
                                                                            authenticator.id,
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
                                <strong
                                    >{{ authenticators.from }}-{{
                                        authenticators.to
                                    }}</strong
                                >
                                of
                                <strong>{{ authenticators.total }}</strong>
                                tags
                            </div>
                        </CardFooter>
                    </Card>
                    <div class="flex justify-center">
                        <Pagination
                            v-slot="{ page }"
                            :total="authenticators.total"
                            :sibling-count="1"
                            show-edges
                            :default-page="1"
                            :items-per-page="authenticators.per_page"
                        >
                            <PaginationList
                                v-slot="{ items }"
                                class="flex items-center gap-1"
                            >
                                <PaginationFirst
                                    @click.prevent="
                                        handlePageChange(
                                            authenticators.first_page_url,
                                        )
                                    "
                                />
                                <PaginationPrev
                                    @click.prevent="
                                        handlePageChange(
                                            authenticators.prev_page_url,
                                        )
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
                                                    authenticators.links[
                                                        item.value
                                                    ].url,
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
                                        handlePageChange(
                                            authenticators.next_page_url,
                                        )
                                    "
                                />
                                <PaginationLast
                                    @click.prevent="
                                        handlePageChange(
                                            authenticators.last_page_url,
                                        )
                                    "
                                />
                            </PaginationList>
                        </Pagination>
                    </div>
                </main>
            </div>
        </div>
    </DashboardStandardLayout>
</template>
