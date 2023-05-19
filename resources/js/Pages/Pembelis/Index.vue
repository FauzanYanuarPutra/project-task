<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                pembeli
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4 flex justify-between items-center">
                            <div>
                                <h1 class="text-[18px] font-[500]">Pembeli</h1>
                            </div>
                            <div>
                              <Link
                                class="
                                    px-6
                                    py-2
                                    mb-2
                                    text-green-100
                                    secondary-background
                                    rounded
                                "
                                :href="route('pembelis.create')"
                            >
                                Tambah Pembeli
                            </Link>

                            <Link
                                class="
                                    px-6
                                    py-2
                                    mb-2
                                    ml-2
                                    text-green-100
                                    bg-red-400
                                    rounded
                                "
                                :href="route('pembelis.indexrestore')"
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
                                    text-green-100
                                    bg-red-400
                                    rounded
                                "
                                :href="route('pembelis.index')"
                                v-if="status == 'back'"
                            >
                                Kembali
                            </Link>
                            </div>
                            
                        </div>
                        
                        <table class="w-full">
                            <thead class="font-bold ">
                                <td class="px-4  border-2 py-2">No</td>
                                <td class="px-4  border-2  py-2">Nama Pembeli</td>
                                <td class="px-4  border-2 py-2">Jenis Kelamin</td>
                                <td class="px-4  border-2 py-2">Alamat</td>
                                <td class="px-4  border-2 py-2">Telp Pembeli</td>


                                <td class="px-4 border-2 py-2">Action</td>
                            </thead>
                            <tbody class="">
                                <tr v-for="pembeli in pembelis" :key="pembeli.id">
                                    <td class="px-4 border-2 py-2">{{ pembeli.id }}</td>
                                    <td class="px-4 border-2 py-2">{{ pembeli.nama_pembeli }}</td>
                                    <td class="px-4 border-2 py-2">
                                        {{ pembeli.alamat_pembeli }}
                                    </td>
                                    <td class="px-4 border-2 py-2">
                                        {{ pembeli.jenis_kelamin_pembeli }}
                                    </td>
                                    <td class="px-4 border-2 py-2">
                                        {{ pembeli.telp_pembeli }}
                                    </td>
                                    <td class="px-4 border-2 py-2 font-extrabold">
                                        <Link
                                            class="text-green-700"
                                            :href="route('pembelis.edit', pembeli.id)"
                                        >
                                            Ubah
                                        </Link>
                                        <Link
                                            @click="destroy(pembeli.id)"
                                            class="text-red-700"
                                            >Hapus</Link
                                        >
                                        <button v-if="pembeli.deleted_at" @click="restoreResource(resource.id)">Restore</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <pagination :links="pembelis.links" /> -->
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
      pembelis: Object,
      status: Object
    },
    methods: {
      softDeletePembeli(id) {
        if (confirm("Anda yakin ingin menghapus postingan ini secara lunak?")) {
          this.$inertia.delete(route('pembelis.softDelete', { id }), {
            preserveScroll: true,
            onSuccess: () => {
              this.$emit('pembeli-deleted');
            },
          });
        }
      },
        destroy(id) {
            this.$inertia.delete(route("pembelis.destroy", id), {
                onBefore: () => confirm('Are you sure you want to delete this pembeli?'),
            });
      },
      // restoreResource(id) {
      //   if (confirm('Are you sure you want to restore this resource?')) {
      //     this.$inertia.put(`/your-resource/${id}/restore`);
      //   }
      // },
    },
};
</script>