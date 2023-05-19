<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-medium leading-tight secondary-color">
                Tambah Barang
            </h2>
        </template>

        <div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-b-md">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="w-full flex justify-between items-center">
                                <label for="title w-[30%] lg:w-[20%] bg-black">Nama Barang</label>
                                <div class="w-[70%]
                                        lg:w-[80%]">
                                    <input
                                    type="text"
                                    placeholder="Masukan Nama Barang"
                                    v-model="form.nama_barang"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        border-gray-400
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    " required
                                />
                                <p class="text-red-600 text-sm ">{{ errors.nama_barang }}</p>

                                </div>
                            </div>

                            <div class="w-full flex justify-between items-center">
                                <label for="title w-[30%] lg:w-[20%] bg-black">Harga Barang</label>
                                <div class="w-[70%]
                                        lg:w-[80%]">
                                    <input
                                    type="text"
                                    v-on:input="formatCurrency"
                                    placeholder="Masukan Harga Barang"
                                    v-model="form.harga_barang"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        border-gray-400
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    " required
                                />
                                <p class="text-red-600 text-sm ">{{ errors.harga_barang }}</p>

                                </div>
                            </div>

                            <div class="w-full flex justify-between items-center">
                                <label for="title w-[30%] lg:w-[20%] bg-black">Stok Barang</label>
                                <div class="w-[70%]
                                        lg:w-[80%]">
                                    <input
                                    type="text"
                                    v-on:input="form.stok_barang = form.stok_barang.replace(/[^0-9]/g, '')"
                                    placeholder="Masukan Jumlah Stok Barang"
                                    v-model="form.stok_barang"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        border-gray-400
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    " required
                                />
                                <p class="text-red-600 text-sm ">{{ errors.stok_barang }}</p>

                                </div>
                                
                            </div>




                            <div class="w-full flex justify-between items-center">
                                <label for="title w-[30%] lg:w-[20%] bg-black">Supplier barang</label>

                                <select class="
                                        w-[70%]
                                        lg:w-[80%]
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        border-gray-400
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600 " v-model="form.id_supplier"  required>
                                            <option v-for="(supplier, index) in suppliers" v-bind:value="supplier.id.toString()" :key="supplier.id.toString()">
                                                        {{ supplier.nama_supplier }}
                                            </option>
                                </select>
                            </div>
                            

                            <!-- submit -->
                            <div class="flex justify-between items-center mt-4 ">
                                <Link
                                    class="
                                        px-6
                                        py-2
                                        mb-2
                                        text-white
                                        bg-gray-400
                                        rounded
                                    "
                                    :href="route('barangs.index')"
                                >
                                    Kembali
                                </Link>
                                <button
                                    class="
                                        px-6
                                        py-2
                                        text-white
                                        secondary-background
                                        rounded
                                    "
                                >
                                    Tambah
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BreezeLabel from "@/Components/InputLabel.vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

export default {
    data() {
        return {
            errors: null,
        }
    },
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
    },
    setup() {
        // const form = useForm({
        //     nama_supplier: null,
        //     alamat_supplier: null,
        //     telp_supplier: null,

        // });

        const form = useForm({
            nama_barang: null,
            harga_barang: null,
            stok_barang: null,
            id_supplier: null,


        });


        return { form };
    },
    props: {
        suppliers: {
            type: Array,
            required: true
        },
        errors: Object
    },
    methods: {
        formatCurrency() {
            const value = this.form.harga_barang.replace(/\D/g, ''); // Menghapus karakter non-digit
            const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Menambahkan titik sebagai pemisah ribuan
            this.form.harga_barang = formattedValue;
        },
        submit() {
            this.form.post(route("barangs.store"));
        },
    },
};
</script>