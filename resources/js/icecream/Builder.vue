<template lang="">
    <div>
        <div class="react" id="builder">
            <div class="builder">
                <h3>
                    Build your own Ice Cream Sundae
                    <span
                        class="quantity"
                        :style="!cart.length > 0 ? { color: 'red' } : {}"
                        >{{ cart.length }}</span
                    >
                </h3>
                <div class="react">
                    <ul>
                        <li
                            class="item"
                            v-for="(item, key) in variants"
                            :key="key"
                        >
                            <span>{{ item.name }}-</span>
                            <span class="quantity"
                                >Price :{{ item.price }}
                            </span>
                            <div class="right">
                                <button
                                    type="button"
                                    @click="addToCart(item.id)"
                                    class="plus rounded"
                                >
                                    +
                                </button>
                                <button
                                    @click="removeFromCart(item.id)"
                                    type="button"
                                    class="minus rounded"
                                >
                                    -
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="total react" id="total">
                    <div>Total Price</div>
                    <div>{{ total }} Tk</div>
                </div>
                <button
                    v-if="auth"
                    :disabled="!cart.length > 0"
                    type="button"
                    @click="modalOpen()"
                    class="order rounded"
                >
                    Process
                </button>
                <router-link
                    v-else
                    :to="{ name: 'Login' }"
                    @click="toaster()"
                    class="order rounded"
                    >Process</router-link
                >
            </div>
            <Form
                v-if="modal"
                v-on:modal-toggle-close="modalOpen"
                v-on:cartEmpty="$emit('emptycart')"
                :amount="total"
                :cart="cart"
            />
        </div>
    </div>
</template>
<script>
import Form from "./Form.vue";
export default {
    components: {
        Form,
    },
    props: ["variants", "total", "cart", "modal"],
    methods: {
        addToCart(id) {
            this.$emit("itemIdPass", id);
        },
        removeFromCart(id) {
            this.$emit("removeId", id);
        },
        modalOpen() {
            this.$emit("modalToggle");
        },
        toaster(){
            this.emitter.emit("notification", {
                        type: "warning",
                        message: "Please login first!!",
                    });
        }
    },
    computed: {
        auth() {
            return this.$store.getters.authentication;
        },
    },
};
</script>
<style lang=""></style>
