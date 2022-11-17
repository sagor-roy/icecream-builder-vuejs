<template lang="">
    <div>
        <div>
            <div class="icecream react" id="icecream">
                <p class="cone"></p>
                <div class="scoop" v-for="(item,key) in variants" :key="key" :style="{background: item.color}"></div>
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
