<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="title">Nama Pembeli</label>
                                <input
                                    type="text"
                                    v-model="form.nama_pembeli"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                />
                            </div>
                            <div>
                                <label for="title">Alamat Pembeli</label>
                                <input
                                    type="text"
                                    v-model="form.alamat_pembeli"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                />
                            </div>
                            <div>
                                <label for="title">Jenis Kelamin</label>
                                <input
                                    type="text"
                                    v-model="form.jenis_kelamin_pembeli"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                />
                            </div>
                            <div class="mt-4">
                                <label for="title">Telp Pembeli</label>
                                <textarea
                                    name="description"
                                    type="text"
                                    v-model="form.telp_pembeli"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                >
                                </textarea>
                            </div>

                            <!-- submit -->
                            <div class="flex items-center mt-4 bg-black">
                                <button
                                    class="
                                        px-6
                                        py-2
                                        text-black
                                        bg-red-300
                                        rounded
                                    "
                                >
                                    Save
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
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    setup() {
        const form = useForm({
            nama_pembeli: null,
            alamat_pembeli: null,
            jenis_kelamin_pembeli: null,
            telp_pembeli: null,

        });

        return { form };
    },
    methods: {
        submit() {
            this.form.post(route("pembelis.store"));
        },
    },
};
</script>