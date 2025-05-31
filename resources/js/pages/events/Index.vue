<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem, Event, Organization } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

interface Props {
    events: [];
    organization: {};
    status?: string;
}

defineProps<Props>();

const page = usePage<SharedData>();
const events = page.props.events as Event[];
const organization = page.props.organization as Organization;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: organization.name,
        href: route('organization.events.index', organization),
    },
];

const form = useForm({
    title: '',
    description: '',
    venue: '',
    date: '',
    price: '',
    max_attendees: '',
});

const submit = () => {
    form.post(route('organization.events.store', organization), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head :title="organization.name + (':Events')" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="col-span-2 relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Event Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Venue
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Attendees
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="event in events" :key="event.id" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ event.title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ event.venue }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ new Date(event.date).toLocaleDateString() }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ event.price ? `$${event.price.toFixed(2)}` : 'Free' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ event.attendees.length }} / {{ event.max_attendees }}
                                    <PlaceholderPattern v-if="event.attendees.length === 0" class="w-24 h-6" />
                                    <span v-else class="text-xs text-gray-500">Attendees list available</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <div class="p-10">
                        <div class="flex flex-col gap-4">
                            <h2 class="text-xl font-semibold">Create Event</h2>
                            <form @submit.prevent="submit" class="space-y-6">
                                <div class="grid gap-2">
                                    <Label for="title">Event Title</Label>
                                    <Input id="title" v-model="form.title" required placeholder="Enter event title" />
                                    <InputError :message="form.errors.title" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="description">Description</Label>
                                    <Input id="description" v-model="form.description" required placeholder="Enter event description" />
                                    <InputError :message="form.errors.description" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="venue">Venue</Label>
                                    <Input id="venue" v-model="form.venue" required placeholder="Enter venue details" />
                                    <InputError :message="form.errors.venue" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="date">Date</Label>
                                    <Input id="date" type="date" v-model="form.date" required />
                                    <InputError :message="form.errors.date" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="price">Price</Label>
                                    <Input id="price" type="number" v-model.number="form.price" required placeholder="Enter ticket price" />
                                    <InputError :message="form.errors.price" />
                                </div>

                                <div class="grid gap-2">
                                    <Label for="max_attendees">Max Attendees</Label>
                                    <Input id="max_attendees" type="number" v-model.number="form.max_attendees" required placeholder="Max number of attendees" />
                                    <InputError :message="form.errors.max_attendees" />
                                </div>

                                <Button type="submit">Create Event</Button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
