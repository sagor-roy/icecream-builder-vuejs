<template lang="">
    <div class="custom__notification">
        <div class="noti">
            <div
                class="noti__header d-flex align-items-center justify-content-between"
            >
                <span>Success</span>
                <i class="fas fa-close"></i>
            </div>
            <div class="noti__body">
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Notification",
};
</script>
<style scoped>
.custom__notification {
    position: fixed;
    top: 0;
    width: 100%;
    right: 0;
    display: flex;
    align-items: center;
    justify-content: space-around;
    z-index: -99;
}

.noti {
    background-color: #198754;
    display: inline-block;
    color: #f1f1f1;
    padding: 0;
}

.noti__header {
    background-color: #015830;
    display: block;
}

.noti__body {
    padding: 0;
    padding-right: 15px;
}
</style>
