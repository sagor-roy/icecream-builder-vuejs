<template lang="">
    <div>
        <Notification v-if="this.$store.state.noti" />
        <router-view></router-view>
    </div>
</template>
<script>
import Notification from "../Notification.vue";
export default {
    components: {
        Notification,
    },
};
</script>
<style lang=""></style>
