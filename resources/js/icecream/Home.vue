<template lang="">
    <div class="react" id="layout">
        <!-- header start -->
        <Header />
        <!-- header end -->

        <!-- body start -->
        <div class="mainBody react" id="body">
            <div class="container react" id="iceCreamBuilder">
                <!-- icecream start -->
                <Icecream :variants="cart" />
                <!-- ice cream end -->
                <Builder
                    v-on:itemIdPass="addItem($event)"
                    v-on:removeId="removeItem($event)"
                    :variants="variants"
                    :total="totalPrice"
                    :cart="cart"
                    :modal="showModal"
                    v-on:modalToggle="modalShow"
                    v-on:emptycart="cartRemoves"
                    v-on:parent="addOrder($event)"
                />
            </div>
            <div
                class="container"
                :style="order.length > 0 ? {} : { borderBottom: 'none' }"
            >
                <OrderTable v-if="order.length > 0" :order="order" />
            </div>
        </div>
        <!-- body end -->

        <!-- footer start -->
        <Footer />
        <!-- footer end -->
    </div>
</template>
<script>
import Header from "./Header.vue";
import Builder from "./Builder.vue";
import Icecream from "./Icecream.vue";
import Footer from "./Footer.vue";
import OrderTable from "./Order.vue";
export default {
    components: {
        Header,
        Builder,
        Icecream,
        Footer,
        OrderTable,
    },
    data() {
        return {
            variants: [
                { id: 1, name: "Chocolate", price: 120 },
                { id: 2, name: "Vanilla", price: 90 },
                { id: 3, name: "Orange", price: 50 },
                { id: 4, name: "Strawberry", price: 80 },
                { id: 5, name: "Lemon", price: 150 },
            ],
            cart: JSON.parse(localStorage.getItem("items")) ?? [],
            totalPrice: 0,
            showModal: false,
            order: JSON.parse(localStorage.getItem("info")) ?? [],
        };
    },
    methods: {
        addItem(id) {
            this.cart.push(this.variants.find((variant) => variant.id === id));
            this.total();
            localStorage.setItem("items", JSON.stringify(this.cart));
        },
        total() {
            this.totalPrice = this.cart.reduce(
                (t, variant) => t + variant.price,
                0
            );
        },
        removeItem(id) {
            let position = this.cart.find((variant) => variant.id === id);
            if (position) {
                this.cart.splice(position, 1);
                localStorage.setItem("items", JSON.stringify(this.cart));
                this.total();
            }
        },
        modalShow() {
            this.showModal = !this.showModal;
        },
        cartRemoves() {
            this.cart = [];
            localStorage.removeItem("items");
            this.totalPrice = 0;
        },
        addOrder(info) {
            this.order.push(info);
            localStorage.setItem("info", JSON.stringify(this.order));
        },
    },
    mounted() {
        // console.log(this.cart) // 0
    },
};
</script>
<style lang=""></style>
