<template lang="">
    <div class="sidebar">
        <ul class="list-group m-3 me-md-0">
            <li class="list-group-item p-0">
                <router-link class="d-block active__class" to="/admin/dashboard"
                    >Dashboard</router-link
                >
            </li>
            <li class="list-group-item p-0">
                <router-link class="d-block active__class" to="/admin/item"
                    >Item</router-link
                >
            </li>
            <li class="list-group-item p-0">
                <router-link class="d-block active__class" to="/admin/chatbot"
                    >Chatbot</router-link
                >
            </li>
        </ul>
    </div>
</template>
<script>
export default {};
</script>
<style scoped></style>
