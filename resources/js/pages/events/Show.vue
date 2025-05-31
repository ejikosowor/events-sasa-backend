<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem, Event, Organization } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';

interface Props {
    event: {};
    events: [];
    organization: {};
    status?: string;
}

defineProps<Props>();

const page = usePage<SharedData>();
const event = page.props.event as Event;
const events = page.props.events as Event[];
const organization = page.props.organization as Organization;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: organization.name,
        href: route('organization.events.index', organization),
    },
    {
        title: event.title,
        href: route('organization.events.show', { organization, event }),
    },
];
</script>

<template>
    <Head :title="organization.name + (':') + event.title" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="col-span-2 relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <div class="p-6">
                        <h1 class="text-2xl font-semibold">{{ event.title }}</h1>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">{{ event.description }}</p>
                        <p class="mt-4 text-sm text-gray-500 dark:text-gray-300">Venue: {{ event.venue }}</p>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Date: {{ new Date(event.date).toLocaleDateString() }}</p>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Price: ${{ event.price.toFixed(2) }}</p>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Max Attendees: {{ event.max_attendees }}</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
