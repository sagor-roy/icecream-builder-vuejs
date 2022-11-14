<template lang="">
    <div>
        <div class="react">
            <div class="backdrop" @click="closeModal()"></div>
            <div class="modalBody">
                <div class="formContainer react" id="orderForm">
                    <h6>Complete the form below and hit submit</h6>
                    <form class="orderForm" @submit.prevent="formSubmit()">
                        <ul>
                            <li>
                                <input
                                    type="text"
                                    v-model="name"
                                    class="fieldStyle fieldSplit alignLeft"
                                    placeholder="Name"
                                />
                                <input
                                    type="number"
                                    v-model="phone"
                                    class="fieldStyle fieldSplit alignRight"
                                    placeholder="Phone no."
                                />
                            </li>
                            <li>
                                <textarea
                                    v-model="address"
                                    class="fieldStyle"
                                    placeholder="Address"
                                ></textarea>
                            </li>
                            <li>
                                <input
                                    :disabled="
                                        name && phone && address ? false : true
                                    "
                                    type="submit"
                                    value="Submit Order"
                                />
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["amount", "cart"],
    data() {
        return {
            name: "",
            phone: "",
            address: "",
            total: this.amount,
            variant: this.cart,
        };
    },
    methods: {
        closeModal() {
            this.$emit("modal-toggle-close");
        },
        formSubmit() {
            if (this.name == "" || this.phone == "" || this.address == "") {
                return alert("The all input field is required");
            }
            let info = {
                name: this.name,
                phone: this.phone,
                address: this.address,
                total: this.total,
                flevour: this.variant,
            };
            axios
                .post("api/order", {
                    headers: {
                        Authorization: "Bearer " + this.$store.getters.token,
                    },
                    name: info.name,
                    phone: info.phone,
                    address: info.address,
                    total: info.total,
                    flevour: info.flevour,
                })
                .then((res) => {
                    if (res.data.status) {
                        this.$router.push("/profile");
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
            this.$emit("cartEmpty");
            this.closeModal();
        },
    },
};
</script>
<style lang=""></style>
