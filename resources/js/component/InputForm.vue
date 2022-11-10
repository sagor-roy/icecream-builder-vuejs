<template>
    <div class="input-group">
        <input
            type="text"
            placeholder="Enter your text...."
            class="form-control"
            v-model="item.title"
            :class="errors ? 'is-invalid' : ''"
        />
        <button
            @click="createList()"
            :class="[item.title ? 'btn-success' : 'btn-secondary', 'btn']"
        >
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <span v-if="errors" class="text-danger"
        ><i>The title field is required</i></span
    >
</template>
<script>
export default {
    data() {
        return {
            item: {
                title: "",
            },
            errors: "",
        };
    },
    methods: {
        createList() {
            axios
                .post("api/store", {
                    title: this.item.title,
                })
                .then((res) => {
                    this.item.title = "";
                    this.errors = "";
                    this.$emit("reloadList");
                })
                .catch((error) => {
                    this.errors = error.response.data.errors.title;
                    console.log(error.response.data.errors.title);
                });
        },
    },
};
</script>
<style lang=""></style>
