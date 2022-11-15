<template lang="">
    <div class="custom__rows">
        <Notification
            v-for="(item, index) in toast"
            :data="item"
            :key="index"
        />
    </div>
    <router-view></router-view>
</template>
<script>
import Notification from "../Notification.vue";
export default {
    data() {
        return {
            toast: [],
        };
    },
    components: {
        Notification,
    },
    mounted() {
        this.emitter.on("notification", (res) => {
            const data = {
                type: res.type,
                message: res.message,
            };
            this.toast.push(data);
            this.disabled();
        });
    },
    methods: {
        disabled() {
            setTimeout(() => {
                this.toast.shift();
            }, 3000);
        },
    },
};
</script>
<style scoped>
.custom__rows {
    position: fixed;
    width: 260px;
    right: 25px;
}
</style>
