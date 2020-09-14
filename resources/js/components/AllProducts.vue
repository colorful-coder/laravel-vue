<template>
<div class="row">
    <add-product @clickAdd="handleClickAdd"></add-product>
    <div class="col-sm-7 ml-3">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col">id</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody v-if="products.length > 0">
                <tr v-for="product in products" :key="product.id">
                    <th scope="row">{{ product.id }}</th>
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td class="text-center">
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#editProduct"
                            @click="editProduct(product.id)"
                        >
                            Edit
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click="deleteProduct(product.id)"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Modal -->
        <div
            class="modal fade"
            id="editProduct"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Editing Product
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form
                        class="mt-3"
                        method="POST"
                        @submit.prevent="updateProduct(editingProduct.id)"
                    >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label
                                    for="add-name"
                                    class="col-sm-2 col-form-label"
                                    >Name:</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="editingProduct.name"
                                        id="add-name"
                                        required
                                    />
                                    <div class="invalid-feedback">
                                        Please select a valid state.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    for="add-price"
                                    class="col-sm-2 col-form-label"
                                    >Price:</label
                                >
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="editingProduct.price"
                                        id="add-price"
                                        required
                                    />
                                    <div class="invalid-feedback">
                                        Please select a valid state.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import AddProduct from './AddProduct.vue';
export default {
    data() {
        return {
            products: [],
            editingProduct: '',
        };
    },
    components: {
        AddProduct
    },
    mounted() {
        this.getAllProducts();
    },
    methods: {
        handleClickAdd: function() {
            alert('Add to the Product List!');
            this.getAllProducts();
        },
        getAllProducts() {
            axios.get("./api/products").then(response => {
                if(response.data) {
                    this.products = response.data;
                }
            });
        },
        deleteProduct(id) {
            alert("Are you sure want to delete the id " + id);
            axios.delete(`./api/delete/${id}`).then(response => {
                let i = this.products.map(item => item.id).indexOf(id);
                this.products.splice(i, 1);
            });
        },
        editProduct(id) {
            axios.get(`./api/edit/${id}`).then(response => {
                this.editingProduct = response.data;
            });
        },
        updateProduct(id) {
            axios.post(`./api/update/${id}`,this.editingProduct).then(response => {
                this.getAllProducts();
                $('#editProduct').modal('hide')
            })
        }
    }
};
</script>
