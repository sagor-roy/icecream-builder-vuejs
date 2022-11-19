<template lang="">
    <div
        class="message d-block"
        v-for="(item, index) in message"
        :key="index"
        :style="
            item.from !== id ? { textAlign: 'left' } : { textAlign: 'right' }
        "
    >
        <p
            :style="
                item.from == id
                    ? {
                          backgroundColor: '#0D6EFD',
                          color: 'white',
                          padding: '10px',
                          borderRadius: '10px',
                          display: 'inline-block',
                      }
                    : {
                          backgroundColor: '#adb5bd',
                          padding: '10px',
                          borderRadius: '10px',
                          display: 'inline-block',
                      }
            "
            class="my-1"
        >
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
