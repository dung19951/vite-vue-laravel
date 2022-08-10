import ProductService from "../services/product.service";
export const product = {
    namespaced: true,
    state: { products: {} },
    getters:{
        productDetail(state,id){
            console.log(state.products);
            return state.products.find(item => item.id === id);
        }
    },
    actions: {
        getAll({ commit }, { self }) {
            return ProductService.getProduct().then(
                (response) => {
                    commit("get", response.data);
                },
                (error) => {}
            );
        },
        createProduct({ commit }, { self, data }) {
            return ProductService.createProduct(data).then((response) => {
                commit('addItem', data)
                self.$router.push({ name: "home" });
            });
        },
        editProduct({ commit }, { self, data }) {
            return ProductService.editProduct(data).then((response) => {
                self.$router.push({ name: "home" });
            });
        },
        deleteProduct({ commit }, id) {
            return ProductService.deleteProduct(id).then((response) => {
                commit("delete", id);
            });
        },
    },
    mutations: {
        get(state, products) {
            state.products = products;
        },
        delete(state, id) {
            state.products = state.products.filter((e) => e.id !== id);
        },
        create(state, newItem){
            state.products.unshift(newItem)
        },
    },
};
