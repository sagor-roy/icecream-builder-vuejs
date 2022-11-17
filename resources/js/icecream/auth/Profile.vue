<template lang="">
    <div class="react">
        <Header />
        <div class="mainBody react" id="body">
            <div class="container">
                <div>
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div class="card card-body text-center shadow">
                                <img
                                    :src="user.img == null ? imgurl : user.img"
                                    style="margin: 0 auto"
                                    width="80"
                                    class="rounded-circle border"
                                />

                                <template v-if="!toggle">
                                    <div
                                        class="d-flex align-items-center justify-content-center"
                                    >
                                        <h4 class="m-0 ms-4">
                                            {{ user.name }}
                                        </h4>
                                        <i
                                            class="fas fa-edit text-primary btn"
                                            @click="open()"
                                            :style="
                                                toggle
                                                    ? { display: 'none' }
                                                    : { display: 'block' }
                                            "
                                        ></i>
                                    </div>
                                    <p>{{ user.email }}</p>
                                </template>
                                <form
                                    @submit.prevent="formSubmit()"
                                    enctype="multipart/form-data"
                                    v-if="toggle"
                                >
                                    <input
                                        type="text"
                                        v-model="name"
                                        class="form form-control my-1"
                                        required
                                    />
                                    <input
                                        type="email"
                                        class="form form-control my-1"
                                        v-model="email"
                                        required
                                    />
                                    <input
                                        type="file"
                                        class="form form-control my-1 mb-3"
                                        @change="handleChange"
                                    />
                                    <br />
                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-info"
                                    >
                                        Update
                                    </button>
                                    <a
                                        @click="close()"
                                        href="javascript:void()"
                                        class="btn btn-sm text-danger ms-2"
                                        ><i class="fas fa-close"></i
                                    ></a>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4" v-if="data_length > 0">
                            <div class="card card-body shadow">
                                <div class="form-group mb-3 text-end">
                                    <input
                                        type="text"
                                        placeholder="Search...."
                                    />
                                </div>
                                <table class="customers">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th width="25%">Item</th>
                                        <th>Status</th>
                                        <th>Payment Method</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr
                                        v-for="(item, index) in items.data"
                                        :key="index"
                                    >
                                        <td>{{ item.id }}</td>
                                        <td>{{ item.name }}</td>
                                        <td>{{ item.phone }}</td>
                                        <td>{{ item.address }}</td>
                                        <td>
                                            <span
                                                class="flavour"
                                                v-for="(fle, i) in item.item"
                                                :key="i"
                                                >{{ fle.name }}-{{
                                                    fle.price
                                                }}&#2547;</span
                                            >
                                        </td>
                                        <td>
                                            <span
                                                class="flavour"
                                                :style="
                                                    item.order_status === 0
                                                        ? {
                                                              backgroundColor:
                                                                  'red',
                                                          }
                                                        : {}
                                                "
                                            >
                                                {{
                                                    !item.order_status
                                                        ? "Pending"
                                                        : "Complete"
                                                }}
                                            </span>
                                        </td>
                                        <td>Bkash</td>
                                        <td>{{ item.price }}&#2547;</td>
                                        <td>
                                            <button
                                                @click="deleteItem(item.id)"
                                                class="btn btn-sm btn-danger"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                                <Pagination
                                    style="
                                        justify-content: flex-end;
                                        margin-top: 15px;
                                    "
                                    :item="items"
                                    v-on:pageId="getsData($event)"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Footer />
    </div>
</template>
<script>
import Header from "../Header.vue";
import Footer from "../Footer.vue";
import Pagination from "../Pagination.vue";
import axios from "axios";
export default {
    components: {
        Header,
        Footer,
        Pagination,
    },

    data() {
        return {
            imgurl: "https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png",
            items: {},
            id: "",
            name: "",
            email: "",
            img: "",
            toggle: false,
            profile: null,
            data_length: 0,
            token: null,
        };
    },
    mounted() {
        this.getsData();
    },
    methods: {
        getsData(pageId = 1) {
            axios
                .get(`api/order-item?page=${pageId}`, {
                    headers: {
                        Authorization: "Bearer " + this.$store.getters.token,
                    },
                })
                .then((res) => {
                    this.items = res.data;
                    this.data_length = res.data.data.length;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        handleChange(e) {
            e.preventDefault();
            this.img = e.target.files[0];
        },
        formSubmit() {
            let data = new FormData();
            data.append("name", this.name);
            data.append("email", this.email);
            data.append("img", this.img);
            axios
                .post(`api/user-update/${this.id}`, data)
                .then((res) => {
                    if (res.data.status) {
                        this.$store.dispatch("update", res.data);
                        this.toggle = false;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        open() {
            this.toggle = true;
        },
        close() {
            this.toggle = false;
        },
        deleteItem(id) {
            axios
                .get(`api/order-delete/${id}`)
                .then((res) => {
                    let position = this.items.data.findIndex(
                        (item) => item.id === id
                    );
                    this.items.data.splice(position, 1);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    computed: {
        user() {
            let user_info = this.$store.getters.user;
            this.id = user_info.id;
            this.name = user_info.name;
            this.email = user_info.email;
            this.profile = user_info.img;
            return user_info;
        },
    },
};
</script>
<style scoped>
.flavour {
    display: inline-block;
    padding: 3px 5px;
    background-color: #04aa6d;
    border-radius: 25px;
    color: white;
    margin: 1px;
    font-style: italic;
    font-size: 12px;
}

input.form.form-control.my-1 {
    padding: 0px 8px;
    width: auto;
    display: inline-block;
}

input.form.form-control.my-1.mb-3 {
    padding: 0px 8px;
    width: 50%;
    display: inline-block;
}
</style>
