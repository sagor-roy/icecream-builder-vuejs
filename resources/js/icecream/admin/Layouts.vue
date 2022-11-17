<template lang="">
    <Navbar />
    <div class="custom__rows">
        <Notification
            v-for="(item, index) in toast"
            :data="item"
            :key="index"
        />
    </div>
    <div class="row">
        <div class="col-md-3">
            <Sidebar />
        </div>
        <div class="col-md-9">
            <div class="card card-body m-3 ms-md-0">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
import Navbar from "./Navbar.vue";
import Sidebar from "./Sidebar.vue";
import Dashboard from "./Dashboard.vue";
import Notification from "../../Notification.vue";
export default {
    data() {
        return {
            toast: [],
        };
    },
    components: {
        Notification,
        Navbar,
        Sidebar,
        Dashboard,
    },
    mounted() {
        this.emitter.on("noti", (res) => {
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
    z-index: 999;
}
</style>
