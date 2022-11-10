<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="card card-body shadow-lg">
                    <h3 class="fw-bold text-center">TODO APP</h3>
                    <hr />
                    <InputForm v-on:reloadList="getList()" />
                    <div class="mt-3">
                        <ViewList v-on:reloadList="getList()" :items="items" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ViewList from "./component/ViewList.vue";
import InputForm from "./component/InputForm.vue";
export default {
    components: {
        InputForm,
        ViewList,
    },
    data() {
        return {
            items: [],
        };
    },
    methods: {
        getList() {
            axios
                .get("api/item")
                .then((res) => {
                    this.items = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    created() {
        this.getList();
    },
};
</script>
