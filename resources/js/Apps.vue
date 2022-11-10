<template lang="">
    <div class="container">
        <div>
            <h1>TODO LIST</h1>

            <input
                type="text"
                placeholder="Enter your text..."
                v-model="name"
            />
            <span><button @click="add()">Add</button></span>

            <ul>
                <li v-for="(item, index) in carts" :key="index">
                    ({{ index }}) {{ item }}
                    <button @click="remove(index)">Delete</button>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
    data() {
        return {
            name: "",
        };
    },
    computed: {
        ...mapGetters({
            carts: "cartItem",
        }),
    },
    methods: {
        add() {
            if (this.name !== "") {
                this.$store.dispatch("itemList", this.name);
                this.name = "";
            }
        },
        remove(id){
            this.$store.dispatch("removeItem", id);
        }
    },
};
</script>
<style lang=""></style>
