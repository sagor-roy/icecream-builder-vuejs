<template lang="">
    <div class="react">
        <!-- header start -->
        <Header />
        <!-- header end -->

        <!-- body start -->
        <div class="mainBody react" id="body">
            <div class="container">
                <h1>Profile</h1>
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
export default {
    components: {
        Header,
        Footer,
    },
};
</script>
<style lang=""></style>
