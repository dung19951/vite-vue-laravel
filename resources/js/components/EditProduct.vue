<template>
    <div>
        <h3 class="text-center">Edit Product</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateProduct">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <input type="text" class="form-control" v-model="product.detail">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
import ProductService from "../services/product.service";
    export default {
        data() {
            return {
                product: {}
            }
        },
        created() {
           ProductService.getProductDetail(this.$route.params.id)
                .then((res) => {
                    this.product = res.data;
                });
        },
        methods: {
            updateProduct() {
                 this.$store.dispatch("product/editProduct", { self: this,data:this.product });
            }
        }
    }
</script>