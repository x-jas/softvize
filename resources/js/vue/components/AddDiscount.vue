<template>
    <div id="container">
        <h1>Add Discount</h1>

        <form @submit.prevent="addDiscount">
            <input v-model="code" placeholder="Discount Code" required />
            <input v-model.number="discount" type="number" placeholder="Discount (%)" required />

            <button type="submit" class="green">Add</button>
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
                discount: null,
            };
        },
        methods: {
            async addDiscount() {
                await axios.post('/api/add-discount', {
                    code: this.code,
                    discount: this.discount,
                });

                this.$router.push('/');
            },
            goBack() {
                this.$router.push('/');
            },
        },
    };
</script>
