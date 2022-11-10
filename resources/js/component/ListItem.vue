<template>
    <div class="mt-1">
        <div class="card card-body py-0 shadow-lg">
            <div class="d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        :id="['check' + item.id]"
                        v-model="item.completed"
                        @change="checkUpdate()"
                    />
                    <label
                        :class="[
                            item.completed == 1 ? 'completed' : '',
                            'form-check-label',
                        ]"
                        :for="['check' + item.id]"
                    >
                        {{ item.title }}
                    </label>
                </div>
                <button @click="removeItem()" class="btn text-danger">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["item"],
    methods: {
        checkUpdate() {
            axios
                .put("api/update/" + this.item.id, {
                    completed: this.item.completed,
                })
                .then((res) => {
                   
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        removeItem() {
            axios
                .delete("api/delete/" + this.item.id)
                .then((res) => {
                    this.$emit("itemUpdate");
                    console.log(res);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
<style scoped>
.completed {
    text-decoration: line-through;
    color: #999999cf;
}
</style>
