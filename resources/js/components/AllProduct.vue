<template>
    <div>
        <h2 class="text-center">Products List</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Detail</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.detail }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link
                                :to="{
                                    name: 'edit',
                                    params: { id: product.id },
                                }"
                                class="btn btn-success"
                                >Edit</router-link
                            >
                            <button
                                class="btn btn-danger"
                                @click="deleteProduct(product.id)"
                            >
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import AdminEnum from "../enums/AdminEnum";
export default {
    data() {
        return {};
    },
    created() {
        console.log(AdminEnum.TRUE);
        this.$store.dispatch("product/getAll", { self: this });
    },
    computed: {
        products() {
            return this.$store.state.product.products;
        },
    },
    methods: {
        deleteProduct(id) {
            this.$store.dispatch("product/deleteProduct", id);
        },
        getAll() {
            return (this.products = this.$store.state.product.products);
        },
    },
};
</script>
