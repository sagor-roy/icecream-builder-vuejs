<template lang="">
    <div class="react">
        <!-- header start -->
        <Header />
        <!-- header end -->

        <!-- body start -->
        <div class="mainBody react" id="body">
            <div class="container">
                <div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-body text-center shadow">
                                <img
                                    :src="imgurl"
                                    style="margin: 0 auto"
                                    width="70"
                                    alt=""
                                />
                                <h4 class="m-0 mt-3"></h4>
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card card-body shadow">
                                <table class="customers">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                    <tr
                                        v-for="(item, index) in user"
                                        :key="index"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ item.name }}</td>
                                        <td>{{ item.email }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- body end -->

        <!-- footer start -->
        <Footer />
        <!-- footer end -->
    </div>
</template>
<script>
import Header from "../Header.vue";
import Footer from "../Footer.vue";
import axios from "axios";
export default {
    components: {
        Header,
        Footer,
    },

    data() {
        return {
            imgurl: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1184px-Vue.js_Logo_2.svg.png",
            user: [],
        };
    },
    mounted() {
        axios
            .get("api/all", {
                headers: {
                    Authorization: "Bearer " + this.$store.getters.token,
                },
            })
            .then((res) => {
                this.user = res.data;
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>
<style lang=""></style>
