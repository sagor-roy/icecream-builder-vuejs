<template lang="">
    <form @submit.prevent="formSubmit()">
        <div class="input-group">
            <input
                required
                v-model="message"
                type="text"
                placeholder="Enter your messsage...."
                class="form-control form-control-lg"
            />
            <button class="btn btn-primary">Send</button>
        </div>
    </form>
</template>
<script>
import axios from "axios";

export default {
    props: ["id"],
    data() {
        return {
            message: "",
        };
    },
    methods: {
        formSubmit() {
            axios
                .post("/api/message/store", {
                    from: this.id,
                    message: this.message,
                })
                .then((res) => {
                    this.message = "";
                    this.$emit("updateMessage", res.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
<style lang=""></style>
