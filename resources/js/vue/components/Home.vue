<template>
    <div id="container">
        <h1>Product Inventory</h1>

        <form>
            <button @click="navigateTo('/add-product')" class="blue">Add Product</button>
            <button @click="navigateTo('/add-discount')" class="green">Add Discount</button>
        </form>

        <ul>
            <li v-for="product in products" :key="product.id" @click="viewProduct(product.id)">
                {{ product.title }} - {{ product.price }}
            </li>
        </ul>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                products: [],
            };
        },
        methods: {
            async fetchProducts() {
                const response = await axios.get('/api/products');
                this.products = response.data;
            },
            navigateTo(route) {
                this.$router.push(route);
            },
            viewProduct(id) {
                this.$router.push('/product/' + id);
            },
        },
        mounted() {
            this.fetchProducts();
        },
    };
</script>
