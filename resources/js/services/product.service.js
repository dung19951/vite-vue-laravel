import axios from "axios";
import apiUrl from "./api-url";

class ProductService {
    getProduct() {
        return axios.get(apiUrl() + "products");
    }
    createProduct(product) {
        return axios.post(apiUrl() + "products", product);
    }
    editProduct(product) {
        return axios.patch(apiUrl() + "products/" + product.id, product);
    }
    deleteProduct(id) {
        return axios.delete(apiUrl() + "products/" + id);
    }
}
export default new ProductService();
