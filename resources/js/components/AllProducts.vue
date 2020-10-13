<template>
  <div class="row">
    <add-product></add-product>
    <div class="col-sm-7 ml-3">
      <table class="table table-striped table-bordered text-center">
        <thead>
          <tr class="text-center">
            <th scope="col">Product Id</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody v-if="products.length > 0">
          <tr v-for="(product, index) in products" :key="index">
            <td scope="row">{{ product.id }}</td>
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
              <h5 class="modal-title">Editing Product</h5>
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
                  <label for="add-name" class="col-sm-2 col-form-label"
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
                  <label for="add-price" class="col-sm-2 col-form-label"
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
import { mapGetters, mapActions } from "vuex";
import AddProduct from "./AddProduct.vue";
export default {
  components: {
    AddProduct,
  },
  computed: {
    ...mapGetters({
      products: "getAllProductsGetters",
      editingProduct: "editingProduct",
    }),
  },
  mounted() {
    this.getAllProducts();
  },
  methods: {
    ...mapActions({
      getAllProducts: "getAllProducts",
      deleteProduct: "deleteProduct",
      editProduct: "editProduct",
    }),

    updateProduct(id) {
      this.$store.dispatch("updateProduct", id);
      $("#editProduct").modal("hide");
      this.$store.dispatch("getAllProducts");
    },
  },
};
</script>
