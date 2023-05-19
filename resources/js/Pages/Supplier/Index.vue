<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-medium leading-tight secondary-color">
                Dashboard
            </h2>
        </template>

        <div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-b-md">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4 flex justify-between items-center">
                            <div>
                                <h1 class="text-[18px] font-[500]"  v-if="status == 'restore'">Supplier</h1>
                                <h1 class="text-[18px] font-[500]"  v-if="status == 'back'">Sampah Supplier</h1>

                            </div>
                            <div>
                            <Link
                                class="
                                    px-6
                                    py-2
                                    mb-2
                                    text-white
                                    secondary-background
                                    rounded
                                "
                                :href="route('suppliers.create')"
                                v-if="status == 'restore'"

                            >
                                Tambah Supplier
                            </Link>

                            <Link
                                class="
                                    px-6
                                    py-2
                                    mb-2
                                    ml-2
                                    text-white
                                    bg-red-400
                                    rounded
                                "
                                :href="route('suppliers.indexrestore')"
                                v-if="status == 'restore'"
                            >
                                Sampah
                            </Link>

                            <Link
                                                class="hapus mx-[1px]"
                                                @click="restoreAll()"
                                                v-if="status == 'back'"
                                            >
                                                Restore All
                                            </Link>

                            <Link
                                class="
                                    px-6
                                    py-2
                                    mb-2
                                    ml-2
                                    text-white
                                    bg-red-400
                                    rounded
                                "
                                :href="route('suppliers.index')"
                                v-if="status == 'back'"
                            >
                                Kembali

                            </Link>
                            </div>
                            
                        </div>

                        <div v-if="status == 'back'" class="bg-red-100 my-3 px-2 py-2 text-red-800">

                        Hati hati dalam penghapusan data, data Barang yang bersangkutan dengan data Supplier akan ikut terhapus permanent dan tidak bisa dikembalikan !!</div>
                        
                        <div class="overflow-y-auto block w-full">
                            <table class=" w-full ">
                                <thead class="font-bold ">
                                    <td class="px-4 overflow-hidden whitespace-nowrap  border-2 py-2 text-center">No</td>
                                    <td class="px-4 overflow-hidden whitespace-nowrap  border-2  py-2">Nama supplier</td>
                                    <td class="px-4 overflow-hidden whitespace-nowrap  border-2 py-2">Alamat</td>
                                    <td class="px-4 overflow-hidden whitespace-nowrap  border-2 py-2 text-end">No Telp</td>


                                    <td class="px-4 border-2 py-2 text-center">Aksi</td>
                                </thead>
                                <tbody class="">
                                    <tr v-for="(supplier, index) in suppliers.data" :key="supplier.id">
                                        <!-- <td class="px-4 border-2 py-2">{{ supplier.id }}</td> -->
                                    <td class="px-4 border-2 py-2 text-center">{{ index + 1}}</td>

                                        <td class="px-4 border-2 py-2">{{ supplier.nama_supplier }}</td>
                                        <td class="px-4 border-2 py-2">
                                            {{ supplier.alamat_supplier }}
                                        </td>
                                    
                                        <td class="px-4 border-2 py-2 text-end">
                                            {{ supplier.telp_supplier }}
                                        </td>
                                        <td class="border-2  font-[500]">
                                            <div class="flex justify-center">
                                            <Link
                                                    class=" mx-[1px] ubah"
                                                    :href="route('suppliers.edit', supplier.id)"
                                                    v-if="!supplier.deleted_at"
                                                >
                                                    Ubah
                                                </Link>
                                                <Link
                                                @click="destroy(supplier.id)"
                                                v-if="!supplier.deleted_at"
                                                class="hapus mx-[1px]"
                                                >Hapus</Link
                                                >
                                                
                                                <Link
                                                    class="ubah mx-[1px]"
                                                    @click="restore(supplier.id)"
                                                    v-if="supplier.deleted_at"
                                                >
                                                    Restore Data
                                                </Link>
                                                <Link
                                                    class="hapus mx-[1px]"
                                                    @click="destroyPermanent(supplier.id)"
                                                    v-if="supplier.deleted_at"
                                                >
                                                    Delete Permanent
                                                </Link>
                                                
                                                <!-- <button v-if="supplier.deleted_at" @click="restoreResource(resource.id)">Restore</button> -->
                                            </div>  
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <pagination-table :pagination="suppliers" @pagination-change-page="fetchData"></pagination-table>

                        <!-- <pagination :links="suppliers.links" /> -->
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>


<script>
import BreezeAuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import PaginationTable from '@/Components/PaginationTable.vue';


export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeNavLink,
        Link,
        PaginationTable

    },
    props: {
      suppliers: Object,
      status: Object
    },
    methods: {
        fetchData(page) {
            this.$inertia.get(`/suppliers?page=${page}`)
                // .then(response => {
                //     // Handle the response and update the data in your component
                // })
                // .catch(error => {
                //     // Handle any errors
                // });
        },
        destroy(id) {
            this.$inertia.delete(route("suppliers.destroy", id), {
                onBefore: () => confirm('Apakah anda yakin akan menghapus supplier?'),
            });
        },
      destroyPermanent(id) {
            this.$inertia.delete(route("suppliers.destroypermanent", id), {
                onBefore: () => confirm('Apakah anda yakin akan menghapus supplier secara Permanent?'),
            });
      },
      restore(id) {
            this.$inertia.put(route("suppliers.restore", id), {
                onBefore: () => confirm('Apakah anda yakin akan mengembalikan data supplier?'),
            });
        },
        restoreAll() {
            this.$inertia.put(route("suppliers.restoreall"), {
                onBefore: () => confirm('Apakah anda yakin akan mengembalikan semua data supplier?'),
            });
        },
    },
};
</script>