<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import type { Event, NavItem, Organization } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const page = usePage<SharedData>();
const events = page.props.events as Event[];
const organization = page.props.organization as Organization;
const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/organization/' + organization.slug + '/events',
        icon: LayoutGrid,
    },
];

const eventsNavItems: NavItem[] = events.map((event) => ({
    title: event.title,
    href: route('organization.events.show', { organization, event }),
    icon: BookOpen,
}));

</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('home')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" label="Platform"/>
            <NavMain :items="eventsNavItems" label="Events"/>
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
