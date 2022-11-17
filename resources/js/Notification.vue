<template lang="">
    <div class="noti" :class="data.type">
        <div
            class="noti__header d-flex align-items-center justify-content-between"
        >
            <span>
                {{
                    data.type == "error"
                        ? "Error!!"
                        : data.type == "success"
                        ? "Success"
                        : "Warning"
                }}</span
            >
            <i class="fas fa-close"></i>
        </div>
        <div class="noti__body">
            <p class="m-0">
                {{
                    data.type == "error"
                        ? "❌"
                        : data.type == "success"
                        ? "✔"
                        : "🙄"
                }}
                {{ data.message }}
            </p>
        </div>
    </div>
</template>
<script>
export default {
    name: "Notification",
    props: ["data"],
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
    display: block;
    color: #f1f1f1;
    padding: 0;
    margin: 5px 0;
}

.noti__header {
    display: block;
    background-color: rgb(0 0 0 / 30%);
    padding: 5px 12px;
}

.noti__body {
    padding: 5px;
    padding-right: 15px;
}

.success {
    background-color: rgb(0, 167, 0);
}
.warning {
    background-color: #ffc107;
    color: #444;
}

.error {
    background-color: rgb(204, 67, 67);
}
</style>
