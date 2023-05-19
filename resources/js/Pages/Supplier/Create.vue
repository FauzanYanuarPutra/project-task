<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-medium leading-tight secondary-color">
                Tambah Supplier
            </h2>
        </template>

        <div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-b-md">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="w-full flex justify-between items-center">
                                <label for="title w-[30%] lg:w-[20%] bg-black">Nama Supplier</label>
                                <div class="w-[70%]
                                        lg:w-[80%]">
                                    <input
                                    type="text"
                                    placeholder="Masukan Nama Supplier"
                                    v-model="form.nama_supplier"
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
                                <p class="text-red-600 text-sm ">{{ errors.nama_supplier }}</p>

                                </div>
                            </div>

                            <div class="w-full flex justify-between items-center">
                                <label for="title w-[30%] lg:w-[20%] bg-black">Alamat Supplier</label>
                                <div class="w-[70%]
                                        lg:w-[80%]">
                                    <input
                                    type="text"
                                    placeholder="Masukan Alamat Supplier"
                                    v-model="form.alamat_supplier"
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
                                <p class="text-red-600 text-sm ">{{ errors.alamat_supplier }}</p>

                                </div>
                            </div>

                            <div class="w-full flex justify-between items-center">
                                <label for="title w-[30%] lg:w-[20%] bg-black">No Telp Supplier</label>
                                <div class="w-[70%]
                                        lg:w-[80%]">
                                    <input
                                    type="text"
                                    v-on:input="form.telp_supplier = form.telp_supplier.replace(/[^0-9]/g, '')"
                                    placeholder="Masukan No Telp Supplier"
                                    v-model="form.telp_supplier"
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
                                <p class="text-red-600 text-sm ">{{ errors.telp_supplier }}</p>

                                </div>
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
                                    :href="route('suppliers.index')"
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
            nama_supplier: null,
            alamat_supplier: null,
            telp_supplier: null,

        });


        return { form };
    },
    props: {
        suppliers: Object,
        errors: Object,
    },
    methods: {
        submit() {
            this.form.post(route("suppliers.store"));
        },
    },
};
</script>