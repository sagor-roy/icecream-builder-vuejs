<template lang="">
    <div class="custom___modal">
        <div @click="toggle()" class="modal__layout"></div>
        <div class="modal__body">
            <form @submit.prevent="formSubmit()">
                <div class="mb-3">
                    <label class="form-label">Item Name</label>
                    <input
                        v-model="name"
                        type="text"
                        class="form-control"
                        placeholder="Enter your item name"
                        required
                    />
                </div>
                <div class="mb-3">
                    <label class="form-label">Color</label>
                    <div class="input-group">
                        <input
                            v-model="color"
                            type="text"
                            class="form-control"
                            placeholder="color"
                            required
                        />
                        <input
                            v-model="color"
                            type="color"
                            class="form-control colors"
                            required
                        />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input
                        v-model="price"
                        type="number"
                        class="form-control"
                        placeholder="Enter your price"
                        required
                    />
                </div>
                <div class="mb-3">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="status"
                        v-model="status"
                    />
                    <label class="form-check-label ms-2" for="status">
                        Status
                    </label>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    props: ["data"],
    data() {
        return {
            id: this.data.id,
            name: this.data.name,
            color: this.data.color,
            price: this.data.price,
            status: this.data.status,
        };
    },
    methods: {
        toggle() {
            this.emitter.emit("toggleModal");
        },
        formSubmit() {
            axios
                .post(`/api/update/items/${this.id}`, {
                    name: this.name,
                    color: this.color,
                    price: this.price,
                    status: this.status,
                })
                .then((res) => {
                    this.emitter.emit("updateData");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
<style lang=""></style>
