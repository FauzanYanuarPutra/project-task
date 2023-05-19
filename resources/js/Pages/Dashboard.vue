<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    barangsCount: {
        type: String,
    },
    suppliersCount: {
        type: String,
    },
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
    
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template -->

        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="w-[100%] h-[150px] rounded-lg overflow-hidden mb-2">
                        <video :src="'/storage/video.mp4'" class="w-[100%] h-[100%] object-cover" autoplay loop muted></video>
                    </div>
                    <div class="flex">

                        <div class="w-[50%] h-20 primary-background secondary-color flex justify-center items-center text-center font-bold"> Barang <br>{{ barangsCount }}</div>

                        <div class="w-[50%] h-20 secondary-background text-white flex justify-center items-center text-center font-bold"> Supplier <br>{{ suppliersCount }}</div>
                    </div>

                    <!-- <div class="my-10">
                        <h1>
                            Nama : Muhammad Fauzan Yanuar Putra
                        </h1>

                        <h1>
                            Telp : 082117148623
                        </h1>
                    </div> -->
                    

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
