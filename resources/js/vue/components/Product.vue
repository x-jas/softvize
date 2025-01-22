<template>
    <div id="container">
        <h1>{{ product.title }}</h1>

        <p>Category: {{ product.category }}</p>
        <p>Description: {{ product.description }}</p>
        <p>Price: ${{ product.price }}</p>

        <p v-if="discount !== product.price">
            Discount: <strong>${{ discount.toFixed(2) }}</strong>
        </p>

        <form>
            <input v-model="code" placeholder="Discount Code" @input="applyDiscount" />
            <p v-if="error">{{ error }}</p>

            <button @click="goBack" class="red">Back</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                code: '',
                error: '',
                product: {},
                discount: 0
            };
        },
        methods: {
            async fetchProduct() {
                const api = '/api/product/' + this.$route.params.id;
                const response = await axios.get(api);

                this.product = response.data;
                this.discount = this.product.price;
            },
            async applyDiscount() {
                if (!this.code) {
                    this.error = '';
                    this.discount = this.product.price;

                    return;
                }

                try {
                    const api = '/api/product/' + this.$route.params.id;
                    const response = await axios.get(api, {
                        params: {
                            code: this.code
                        },
                    });

                    this.error = '';
                    this.discount = response.data.discount;
                } catch (error) {
                    this.error = 'Invalid Discount';
                    this.discount = this.product.price;
                }
            },
            goBack() {
                this.$router.push('/');
            },
        },
        async mounted() {
            await this.fetchProduct();
        },
    };
</script>
