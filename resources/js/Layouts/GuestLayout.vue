<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import FooterSinau from '@/Components/FooterSinau.vue';


import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="h-[100vh] w-[100%]  flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-[100%] md:w-[90%] md:flex grid justify-items-center items-center flex-wrap ">
                <div class="md:w-[50%] w-[90%]  grid justify-items-center">
                <Link href="/">
                    <!-- <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" /> -->
                    <img :src="'/storage/sinau.png'" alt="" width="200" class="" >
                </Link>

                    <div class="text-center mt-2">
                        <h1 class="text-4xl font-[1000] secondary-color">Selamat Datang</h1>
                        <p class="font-[700] text-md secondary-color">MARKETPLACE sinau coding</p>
                    </div>
            </div>

            <div class="md:w-[50%] w-[90%]  sm:max-w-md mt-6  ">
                <div class="bg-red-200 h-12 text-[20px] flex justify-center font-[600] secondary-color primary-background items-center rounded-t-lg">
                    <slot name="header" />
                    
                </div>
                    <div
                        class=" px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-b-lg"
                    >   
            
                        <slot />
                    </div>
                </div>
            </div>
    <footer-sinau></footer-sinau>

    </div>


</template>

