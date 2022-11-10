<template lang="">
    <div>
        <header>
            <div class="container react" id="header">
                <div>
                    <router-link :to="{ name: 'Home' }"
                        ><img class="logo" :src="imgurl" alt="Logo"
                    /></router-link>
                </div>
                <div class="textRight">
                    <template v-if="!auth">
                        <router-link to="/login" class="btn"
                            >Sign In</router-link
                        >
                        <router-link to="/register" class="btn"
                            >Sign Up</router-link
                        >
                    </template>

                    <template v-if="user">
                        <router-link to="/profile" class="btn">{{ user.name }}</router-link>
                        <router-link to="/register" class="btn"
                            >Logout</router-link
                        >
                    </template>
                </div>
            </div>
        </header>
    </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
    data() {
        return {
            imgurl: "https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1184px-Vue.js_Logo_2.svg.png",
        };
    },
    computed: {
        ...mapGetters({
            auth: "auth/authenticated",
            user: "auth/user",
        }),
    },
};
</script>
<style scoped>
.btn {
    background-color: #3fb984;
    display: inline-block;
    margin: 0 5px;
    border-radius: 25px;
    padding: 5px 10px;
    color: white;
    box-shadow: 0 2px 5px 2px rgb(0 0 0 / 20%);
}
</style>
