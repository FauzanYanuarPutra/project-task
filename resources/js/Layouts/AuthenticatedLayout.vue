<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import LinkMenu from '@/Components/LinkMenu.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import OnlineDate from '@/Components/OnlineDate.vue';

import { Link } from '@inertiajs/vue3';
import FooterSinau from '@/Components/FooterSinau.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="primary-background border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')" class="flex">
                                    <h1 class="font-black text-xl secondary-color mr-1">MARKETPLACE</h1>
                                    <img :src="'/storage/sinau.png'" alt="" width="100">
                                    <!-- <ApplicationLogo
                                        class="block h-9 w-auto fill-current secondary-color"
                                    /> -->
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>
                            </div> -->
                        </div>

                        <div class="hidden md:flex md:items-center md:ml-6">
                            <!-- Settings Dropdown -->
                            
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <img :src="'/storage/profil.jpg'" alt="" width="50" height="50" class="rounded-full cursor-pointer">
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center md:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="md:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')" class="secondary-color">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('barangs.index')" :active="route().current('barangs*')" class="secondary-color">
                            Barang
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('suppliers.index')" :active="route().current('suppliers*')" class="secondary-color">
                            Supplier
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base secondary-color">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')" class="secondary-color"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="secondary-color">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <!-- <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
                
            </header> -->

            

            <!-- Page Content -->
            <main  class="pb-[200px]">
                <div class=" mt-6  flex  justify-center">
                    <div class="w-[300px]  hidden md:block  ">
                        <div class="flex justify-center ">
                            <div class="bg-white w-[200px] h-[260px] rounded-md shadow-lg">
                                <div class="h-[200px]  rounded-t-md">
                                    <img :src="'/storage/profil.jpg'" alt="" class="w-full h-full">
                                </div>
                                <div class="flex text-[19px] justify-center items-center h-[60px] font-medium primary-background secondary-color rounded-b-md">
                                    {{ $page.props.auth.user.name }}
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center mt-3 ">
                            <div class="bg-white w-[200px] rounded-md shadow-lg">
                                <div class="flex justify-center items-center h-[60px] font-medium primary-background secondary-color text-lg rounded-t-md">
                                    Menu
                                </div>
                                <LinkMenu :href="route('dashboard')" :active="route().current('dashboard*')" class="inline-block w-full px-3 py-3 font-medium">
                                    Dashboard
                                </LinkMenu>
                                <LinkMenu :href="route('barangs.index')" :active="route().current('barangs*')" class="inline-block w-full px-3 py-3 font-medium">
                                    Barang
                                </LinkMenu>
                                <LinkMenu :href="route('suppliers.index')" :active="route().current('suppliers*')" class="inline-block w-full px-3 py-3 font-medium">
                                    Supplier
                                </LinkMenu>
                            
                                
                            </div>
                        </div>

                        <online-date></online-date>


                    </div>
                    <div class="xl:w-[85%] lg:w-[76%] md:w-[70%] sm:w-[95%] w-[95%]">
                        <header class=" mx-auto max-w-7xl sm:px-6 lg:px-8" v-if="$slots.header">
                        <div class="primary-background secondary-color border-b-[1px] rounded-t-md  border-[#438ACA] px-2 py-3">     
                            <h1><slot name="header" /></h1>
                        </div>
                        </header>
                            <slot />
                        
                    </div>

                    
                </div>
            </main>


            <footer-sinau></footer-sinau>
        </div>
    </div>
</template>

