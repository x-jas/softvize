<template>
    <div id="container">
        <h1>Add Product</h1>

        <form @submit.prevent="addProduct">
            <input v-model="title" placeholder="Title" required />
            <textarea v-model="description" placeholder="Description" required></textarea>
            <input v-model.number="price" type="number" placeholder="Price" required />
            <input v-model="category" placeholder="Category" required />

            <button type="submit" class="blue">Add</button>
            <button @click="goBack" class="red">Back</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                title: '',
                description: '',
                price: null,
                category: '',
            };
        },
        methods: {
            async addProduct() {
                await axios.post('/api/add-product', {
                    title: this.title,
                    description: this.description,
                    price: this.price,
                    category: this.category,
                });

                this.$router.push('/');
            },
            goBack() {
                this.$router.push('/');
            },
        },
    };
</script>
