
import Repository from "./Repository";

const resource="/products";
class ProductService {
    getProduct() {
        return Repository.get(`${resource}`);
    }
    createProduct(product) {
        return Repository.post(`${resource}`, product);
    }
    editProduct(product) {
        return Repository.put(`${resource}/${product.id}`, product);
    }
    deleteProduct(id) {
        return Repository.delete(`${resource}/${id}`);
    }
}
export default new ProductService();
