<template>
    <Bootstrap5Pagination
        :data="props.item"
        @pagination-change-page="getResults"
    />
</template>

<script setup>
import { Bootstrap5Pagination } from "laravel-vue-pagination";

const emit = defineEmits(["pageId"]);
const props = defineProps(["item"]);

const getResults = (id) => {
    emit("pageId", id);
};
</script>
