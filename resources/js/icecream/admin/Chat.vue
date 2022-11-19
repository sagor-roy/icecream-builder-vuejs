<template lang="">
    <h4>
        {{ info.name }}
    </h4>
    <div class="row">
        <div class="col-md-3">
            <h5></h5>
            <ul class="list-group chatlist">
                <User @selectUserId="getUserId" />
            </ul>
        </div>
        <div v-if="selectedUser.status" class="col-md-9">
            <div class="card card-body message__box" ref="feed">
                <div class="message__list">
                    <Message :message="messages" :id="selectedUser.id" />
                </div>
            </div>
            <div class="my-2">
                <Input
                    :id="selectedUser.id"
                    @updateMessage="getUpdateMessage"
                />
            </div>
        </div>
        <div v-else class="col-md-9">
            <div class="card card-body">
                <div
                    class="d-flex align-items-center justify-content-center"
                    style="height: 50vh"
                >
                    <h4>No Selected User</h4>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import User from "./User.vue";
import Message from "./Message.vue";
import Input from "./Input.vue";
import axios from "axios";
export default {
    components: {
        User,
        Message,
        Input,
    },
    data() {
        return {
            selectedUser: {
                id: null,
                status: false,
            },
            messages: [],
            info: {},
        };
    },
    methods: {
        getUserId(id) {
            axios
                .get(`/api/user/message/${id}`)
                .then((res) => {
                    this.selectedUser.id = id;
                    this.selectedUser.status = true;
                    this.messages = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getUpdateMessage(message) {
            this.messages.push(message);
        },
    },
    mounted() {
        const info = this.$store.getters.user;
        this.info = info;
        window.Echo.private(`messages.${info.id}`).listen("NewMessage", (e) => {
            if (this.selectedUser.id == e.message.to) {
                this.messages.push(e.message);
            }
        });
    },
};
</script>
