export default {
    state: {
        products: {
            id: '',
            name: '',
            price: ''
        },
        editingProduct: ""
    },

    getters: {
        getAllProductsGetters(state) {
            return state.products;
        },
        editingProduct(state) {
            return state.editingProduct;
        }
    },

    actions: {
        addProduct({ commit } , newProduct) {
            commit('add_product', newProduct);
        },

        getAllProducts(context) {
            axios
                .get("./api/product")
                .then(response => {
                if (response.data) {
                    context.commit("all_products", response.data);
                }
                })
                .catch(error => console.log(error));
        },

        deleteProduct({ commit }, id) {
            commit('delete_product', id);
        },

        editProduct({ commit }, id) {
            commit('edit_product', id);
        },

        updateProduct({ commit }, id) {
            commit('update_product', id);
        }
    },

    mutations: {
        all_products(state, data) {
            return (state.products = data);
        },

        add_product(state, newProduct) {
            axios
                .post("./api/product", {
                    name: newProduct.name,
                    price: newProduct.price
                })
                .then(response => {
                    state.products.push(newProduct);
                })
                .catch(error => {
                    console.log(error);
                });
        },

        delete_product(state, id) {
            alert("Are you sure want to delete the id " + id);
            axios
                .delete(`./api/product/${id}`)
                .then(response => {
                let i = state.products.map(item => item.id).indexOf(id);
                state.products.splice(i, 1);
                })
                .catch(error => {
                    console.log(error);
                });
        },

        edit_product(state, id) {
            axios
                .get(`./api/product/${id}`)
                .then(response => {
                state.editingProduct = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        update_product(state, id) {
            axios
                .put(`./api/product/${id}`, state.editingProduct)
                .then(response => {
                    return response;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
