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
                                <h1 class="text-[18px] font-[500]">Barang</h1>
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
                                :href="route('barangs.create')"
                                v-if="status == 'restore'"

                                
                            >
                                Tambah barang
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
                                :href="route('barangs.indexrestore')"
                                v-if="status == 'restore'"
                            >
                                Sampah
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
                                :href="route('barangs.index')"
                                v-if="status == 'back'"
                            >
                                Kembali
                            </Link>
                            </div>
                            
                        </div>

                        <div v-if="status == 'back'" class="bg-red-100 my-3 px-2 py-2 text-red-800">
                       

                        Hati hati dalam penghapusan data, data yang sudah dihapus permanent tidak akan bisa dikebalikan. !!</div>
                        <div class="overflow-y-auto block w-full">
                            <table class="w-full">
                                <thead class="font-bold ">
                                    <td class="px-4 overflow-hidden whitespace-nowrap  border-2 py-2">No</td>
                                    <td class="px-4 overflow-hidden whitespace-nowrap  border-2  py-2">Nama Barang</td>
                                    <td class="px-4 overflow-hidden whitespace-nowrap  border-2 py-2">Stock</td>
                                    <td class="px-4 overflow-hidden whitespace-nowrap  border-2 py-2">Harga</td>
                                    <td class="px-4 overflow-hidden whitespace-nowrap  border-2 py-2">Nama Supplier</td>
                                    <td class="px-4 overflow-hidden whitespace-nowrap  border-2 py-2">Alamat Supplier</td>
                                    <td class="px-4 overflow-hidden whitespace-nowrap  border-2 py-2">No Telp Supplier</td>
                                    <td class="px-4 overflow-hidden whitespace-nowrap border-2 py-2 text-center">Aksi</td>
                                </thead>
                                <tbody class="">
                                    <tr v-for="(barang, index) in barangs" :key="barang.id">
                                        <td class="px-4 border-2 py-2">{{ index + 1}}</td>
                                        <td class="px-4 border-2 py-2">{{ barang.nama_barang }}</td>
                                        <td class="px-4 border-2 py-2">
                                            {{ barang.stok_barang }}
                                        </td>
                                        <td class="px-4 border-2 py-2">
                                            {{ barang.harga_barang }}
                                        </td>
                                        <td class="px-4 border-2 py-2">
                                            {{ barang.nama_supplier }}
                                        </td>
                                        <td class="px-4 border-2 py-2">
                                            {{ barang.alamat_supplier }}
                                        </td>
                                        <td class="px-4 border-2 py-2">
                                            {{ barang.telp_supplier }}
                                        </td>
                    
                                        <td class="border-2  font-[500]">
                                            <div class="flex justify-center mx-[1px]">
                                            <Link
                                                    class=" mx-[1px] ubah"
                                                    :href="route('barangs.edit', barang.id)"
                                                    v-if="!barang.deleted_at"
                                                >
                                                    Ubah
                                                </Link>
                                                <Link
                                                @click="destroy(barang.id)"
                                                v-if="!barang.deleted_at"
                                                class="hapus mx-[1px]"
                                                >Hapus</Link
                                                >
                                                <Link
                                                    class="ubah mx-[1px]"
                                                    @click="restore(barang.id)"
                                                    v-if="barang.deleted_at"
                                                >
                                                    Restore Data
                                                </Link>

                                                <Link
                                                    class="hapus mx-[1px]"
                                                    @click="destroyPermanent(barang.id)"
                                                    v-if="barang.deleted_at"
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
                        
                        <!-- <pagination :links="barangs.links" /> -->
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

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeNavLink,
        Link,
    },
    props: {
      barangs: Object,
      status: Object
    },
    methods: {
        destroy(id) {
            this.$inertia.delete(route("barangs.destroy", id), {
                onBefore: () => confirm('Apakah anda yakin akan menghapus barang?'),
            });
        },
      destroyPermanent(id) {
            this.$inertia.delete(route("barangs.destroypermanent", id), {
                onBefore: () => confirm('Apakah anda yakin akan menghapus barang secara Permanent?'),
            });
      },
      restore(id) {
            this.$inertia.put(route("barangs.restore", id), {
                onBefore: () => confirm('Apakah anda yakin akan mengembalikan data barang?'),
            });
        },
        restoreAll() {
            this.$inertia.put(route("barangs.restoreall"), {
                onBefore: () => confirm('Apakah anda yakin akan mengembalikan semua data barang?'),
            });
        },
    },
};
</script>