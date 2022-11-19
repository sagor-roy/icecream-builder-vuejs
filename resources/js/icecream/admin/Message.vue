<template lang="">
    <div
        class="message d-block"
        v-for="(item, index) in message"
        :key="index"
        :style="
            item.from !== id ? { textAlign: 'left' } : { textAlign: 'right' }
        "
    >
        <p :class="[item.from == id ? 'sender' : 'receiver']" class="my-1">
            {{ item.message }}
        </p>
    </div>
</template>
<script>
export default {
    props: ["message", "id"],
    data() {
        return {
            userId: null,
        };
    },
    mounted() {
        this.userId = this.$store.getters.user;
    },
};
</script>

<style scoped>
.sender {
    background-color: #0d6efd;
    color: white;
    padding: 10px;
    border-radius: 10px;
    display: inline-block;
}

.receiver {
    background-color: #adb5bd;
    padding: 10px;
    border-radius: 10px;
    display: inline-block;
}
</style>
