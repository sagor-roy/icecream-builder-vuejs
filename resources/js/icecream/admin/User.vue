<template lang="">
    <li class="list-group-item p-0" v-for="(item, index) in user" :key="index">
        <button
            :style="
                userId === item.id
                    ? { backgroundColor: '#0D6EFD', color: 'white' }
                    : {}
            "
            @click="getUserId(item.id)"
        >
            {{ item.name }}
        </button>
    </li>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            user: [],
            userId: null,
        };
    },
    emits: {
        selectUserId: null,
    },
    methods: {
        getData() {
            axios
                .get("/api/all")
                .then((res) => {
                    this.user = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getUserId(id) {
            this.userId = id;
            this.$emit("selectUserId", id);
        },
    },
    mounted() {
        this.getData();
    },
};
</script>
