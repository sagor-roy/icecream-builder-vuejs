<template lang="">
    <table class="customers">
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th width="30%">Item</th>
            <th>Taka</th>
        </tr>
        <tr v-for="(item,index) in order" :key="index">
            <td>{{ item.name }}</td>
            <td>{{ item.phone }}</td>
            <td>{{ item.address }}</td>
            <td>
                <span class="flavour" v-for="(val,index) in item.flevour">{{ val.name }}-{{ val.price }} &#2547;</span>
            </td>
            <td>{{ item.total }} &#2547;</td>
        </tr>
    </table>
</template>
<script>
export default {
    props: ["order"],
};
</script>
<style scoped>
.flavour{
    display: inline-block;
    padding: 3px 5px;
    background-color: #04AA6D;
    border-radius: 25px;
    color: white;
    margin: 1px;
    font-style: italic;
    font-size: 12px;
}
</style>
