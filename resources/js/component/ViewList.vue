<template>
    <div v-for="(item, index) in items" :key="index">
        <ListItem v-on:itemUpdate="$emit('reloadList')" :item="item" />
    </div>
</template>
<script>
import ListItem from "./ListItem.vue";
export default {
    components: {
        ListItem,
    },
    props: ["items"],
};
</script>
<style lang=""></style>
