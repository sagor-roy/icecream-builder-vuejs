<template lang="">
    <div class="d-flex align-items-center justify-content-between">
        <h4>Item List</h4>
        <router-link class="btn btn-primary text-white" to="/admin/item/create"
            ><i class="fas fa-plus"></i> Create</router-link
        >
    </div>
    <hr />
    <div class="d-flex align-items-center justify-content-between mt-3">
        <select v-model="sorting" style="width: 10%">
            <option value="" disabled>Sort :</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <input type="search" placeholder="Search...." v-model="search" />
    </div>
    <table class="customers mt-3" style="text-align: center">
        <tr>
            <th class="d-flex align-items-center justify-content-center">
                <input
                    type="checkbox"
                    id="all"
                    @change="selectAll($event)"
                    v-model="checkAll"
                />
                <label for="all" class="ms-1"
                    >All
                    <span style="color: black"
                        >({{ check.length }})</span
                    ></label
                >
            </th>
            <th>Name</th>
            <th>Color</th>
            <th>Price</th>
            <th>Status</th>
            <th width="20%">Action</th>
        </tr>
        <tr v-for="(item, index) in items.data">
            <td><input type="checkbox" :value="item.id" v-model="check" /></td>
            <td>{{ item.name }}</td>
            <td>
                <span
                    class="colors"
                    :style="{ backgroundColor: item.color }"
                ></span>
            </td>
            <td>{{ item.price }}&#2547;</td>
            <td>
                <label class="switch">
                    <input
                        type="checkbox"
                        v-model="item.status"
                        @change="checkUpdate(item.id)"
                    />
                    <span class="slider round"></span>
                </label>
            </td>
            <td>
                <button
                    @click="editItem(item.id)"
                    class="btn btn-sm mx-1 btn-info"
                >
                    <i class="fas fa-edit"></i>
                </button>
                <button
                    @click="itemsDelete(item.id)"
                    class="btn btn-sm mx-1 btn-danger"
                >
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
    </table>

    <Modal v-if="modal" :data="modalItem" />

    <div class="d-flex align-items-center justify-content-between mt-3">
        <select :disabled="check.length == 0" v-model="selected">
            <option value="" disabled>Select option</option>
            <option value="1">Active</option>
            <option value="0">Deactive</option>
            <option value="delete">Delete</option>
        </select>
        <Pagination :item="items" v-on:pageId="getsData($event)" />
    </div>
</template>
<script>
import Modal from "./ItemModal.vue";
import axios from "axios";
import Pagination from "../Pagination.vue";
export default {
    components: {
        Pagination,
        Modal,
    },
    data() {
        return {
            items: {},
            modal: false,
            modalItem: null,
            check: [],
            checkAll: false,
            selected: "",
            sorting: "",
            search: "",
        };
    },
    methods: {
        getsData(page = 1) {
            axios
                .get(`/api/items/get?page=${page}&sorting=${this.sorting}`)
                .then((res) => {
                    this.items = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        checkUpdate(id) {
            axios
                .get(`/api/items/${id}`)
                .then(() => {
                    this.getsData(this.items.current_page);
                })
                .catch((error) => {});
        },
        itemsDelete(id) {
            axios
                .get(`/api/items/delete/${id}`)
                .then((res) => {
                    let position = this.items.data.findIndex(
                        (item) => item.id === id
                    );
                    this.items.data.splice(position, 1);
                    if (this.items.data.length == 0) {
                        if (this.items.current_page == 1) {
                            this.getsData(this.items.current_page);
                        } else {
                            this.getsData(this.items.current_page - 1);
                        }
                    } else {
                        this.getsData(this.items.current_page);
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        editItem(id) {
            axios
                .get(`/api/single/items/${id}`)
                .then((res) => {
                    this.modal = true;
                    this.modalItem = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        selectAll(event) {
            if (event.target.checked === false) {
                this.check = [];
            } else {
                this.items.data.forEach((item) => {
                    this.check.push(item.id);
                });
            }
        },
    },
    mounted() {
        this.getsData();
        this.emitter.on("toggleModal", () => {
            this.modal = false;
            this.modalItem = null;
        });
        this.emitter.on("updateData", (id) => {
            this.modal = false;
            let position = this.items.data.findIndex((item) => item.id === id);
            this.items.data.splice(position, 1);
            this.getsData(this.items.current_page);
        });
    },
    watch: {
        check(check) {
            this.checkAll = check.length === this.items.data.length;
        },
        selected(selected) {
            axios
                .post("/api/items/status", {
                    status: selected,
                    item: this.check,
                })
                .then((res) => {
                    this.selected = "";
                    this.check = [];
                    this.getsData(this.items.current_page);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        sorting(sorting) {
            axios
                .get(
                    `/api/items/get?page=${this.items.current_page}&sorting=${sorting}`
                )
                .then((res) => {
                    this.items = {};
                    this.items = res.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        search(search) {
            this.items.data = this.items.data.filter((item) => {
                return (
                    item.name.toLowerCase().indexOf(search.toLowerCase()) > -1
                );
            });
        },
    },
};
</script>
<style scoped>
span.colors {
    padding: 2px 10px;
    border-radius: 25px;
}

.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: 0.4s;
    transition: 0.4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: 0.4s;
    transition: 0.4s;
}

input:checked + .slider {
    background-color: #2196f3;
}

input:focus + .slider {
    box-shadow: 0 0 1px #2196f3;
}

input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
</style>
