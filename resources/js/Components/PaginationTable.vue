<template>
    <ul class="pagination flex justify-end my-5 mt-10">
        <li  class="mx-2" >
        <!-- v-if="pagination.current_page > 1" -->
            <a @click.prevent="changePage(pagination.current_page - 1)" href="#">Previous</a>
        </li>
        <li   v-for="page in pages" :key="page" :class="{ active: page === pagination.current_page }">
            <a @click.prevent="changePage(page)" href="#" class="mx-2   px-2 rounded-lg ">{{ page }}</a>
        </li>
        <li  class="mx-2" >
        <!-- v-if="pagination.current_page < pagination.last_page" -->
            <a @click.prevent="changePage(pagination.current_page + 1)" href="#">Next</a>
        </li>
    </ul>
</template>

<style>
.active {
  background-color: #438ACA;
  border-radius: 20px;
  color: white;
}
</style>

<script>
import PageActive from '@/Components/PageActive.vue';


export default {
    components: {
        PageActive
    },
    props: {
        pagination: Object, // The paginated data object received as a prop
    },
    computed: {
        pages() {
            if (!this.pagination.to) {
                return [];
            }
            let from = this.pagination.current_page - 2;
            if (from < 1) {
                from = 1;
            }
            let to = from + (2 * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            const pagesArray = [];
            for (let page = from; page <= to; page++) {
                pagesArray.push(page);
            }
            return pagesArray;
        },
    },
    methods: {
        changePage(page) {
            this.$emit('pagination-change-page', page);
        },
    },
};
</script>
