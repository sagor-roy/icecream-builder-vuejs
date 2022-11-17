<template lang="">
    <div class="d-flex align-items-center justify-content-between">
        <h4>Item Edit</h4>
        <router-link class="btn btn-primary text-white" to="/admin/item"
            ><i class="fas left-arrow"></i> Back</router-link
        >
    </div>
    <hr />
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card card-body">
                <form @submit.prevent="formSubmit()">
                    <div class="mb-3">
                        <label class="form-label">Item Name</label>
                        <input
                            type="text"
                            v-model="item.name"
                            class="form-control"
                            placeholder="Enter your item name"
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <div class="input-group">
                            <input
                                type="text"
                                v-model="item.color"
                                class="form-control"
                                placeholder="color"
                                required
                            />
                            <input
                                v-model="item.color"
                                type="color"
                                class="form-control colors"
                                required
                            />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input
                            type="number"
                            v-model="item.price"
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
                            v-model="item.status"
                        />
                        <label class="form-check-label ms-2" for="status">
                            Status
                        </label>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary" type="submit">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            item: {
                color: "",
                name: "",
                price: "",
                status: false,
            },
        };
    },
    methods: {
        formSubmit() {
            axios
                .post("/api/items/store", this.item)
                .then(() => {
                    this.item = {};
                    this.emitter.emit("noti", {
                        type: "success",
                        message: "Item store successfully!!",
                    });
                    this.$router.push('/admin/item')
                })
                .catch(() => {
                    this.item = {};
                    this.emitter.emit("noti", {
                        type: "error",
                        message: "Something is wrong!!",
                    });
                });
        },
    },
    mounted(){
        console.log(this.$router.params.id);
    }
};
</script>
<style lang=""></style>
