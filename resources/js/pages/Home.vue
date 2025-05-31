<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { type Organization } from '@/types';

import AppLogoIcon from '@/components/AppLogoIcon.vue';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { LoaderCircle, LogOut } from 'lucide-vue-next';

interface Props {
    organizations: Organization[];
    status?: string;
}

defineProps<Props>();

const form = useForm({
    name: '',
});

const showCreateOrganizationForm = ref(false);

const submit = () => {
    form.post(route('organization.store'), {
        onFinish: () => form.reset('name'),
    });
};

const handleLogout = () => {
    router.flushAll();
};

</script>

<template>
    <Head title="Organizations"/>
    <div class="flex min-h-svh flex-col items-center justify-center gap-6 bg-background p-6 md:p-10">
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-8">
                <div v-if="organizations && !showCreateOrganizationForm" class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <h1 class="text-xl font-medium leading-none text-gray-900 dark:text-white text-center mb-4">Your Organizations</h1>
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="py-3 sm:py-4" v-for="organization in organizations" :key="organization.id">
                                <div class="flex items-center">
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-md font-medium text-gray-900 truncate dark:text-white">{{ organization.name }}</p>
                                    </div>
                                    <div class="inline-flex items-center text-sm font-thin text-gray-900 dark:text-white">
                                        <TextLink :href="route('organization.events.index', organization)" class="underline underline-offset-4" :tabindex="6">View</TextLink>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <Button type="button" class="mt-2 w-full" tabindex="5" @click="showCreateOrganizationForm = true">
                        Add New Organization
                    </Button>
                </div>
                <div v-if="!organizations || showCreateOrganizationForm" class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <div class="space-y-2 text-center">
                        <h1 class="text-xl font-medium">New Organization</h1>
                        <p class="text-center text-sm text-muted-foreground">Create a new organization</p>
                    </div>
                    <div class="flow-root">
                        <form @submit.prevent="submit" class="mt-6">
                            <div class="grid gap-6">
                                <div class="grid gap-2">
                                    <Label for="name">Name</Label>
                                    <Input id="name" type="text" required autofocus :tabindex="1" autocomplete="name" v-model="form.name" placeholder="Organization Name" />
                                    <InputError :message="form.errors.name" />
                                </div>
                                <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="form.processing">
                                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                    Submit
                                </Button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center text-sm text-muted-foreground">
                    <Link class="block w-full underline underline-offset-4" method="post" :href="route('logout')" @click="handleLogout" as="button">
                        Log out
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
