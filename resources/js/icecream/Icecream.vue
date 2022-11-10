<template lang="">
    <div>
        <div>
            <div class="icecream react" id="icecream">
                <p class="cone"></p>
                <!-- <p>Please start adding scoops</p> -->
                <div class="scoop" v-for="(item,key) in variants" :key="key" :class="item.name.toLowerCase()"></div>
                <div class="cherry" v-if="variants.length > 0"></div>
                <div class="question" v-else></div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['variants']
};
</script>
<style lang=""></style>
