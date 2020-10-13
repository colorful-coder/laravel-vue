<template>
  <div class="col-sm-4 border border-success rounded" style="height: 250px">
    <form
      class="mt-3"
      action="./api/product"
      method="POST"
      v-on:submit="validateForm"
      @submit.prevent="addProduct()"
    >
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name:</label>
        <div class="col-sm-10">
          <div class="form-group" :class="{ 'has-warning': showError && missingName }">
            <input id="name" name="name" class="form-control form-control-warning" type="text" v-model="product.name">
            <div class="form-control-feedback text-danger" v-if="showError && missingName">This field is required.</div>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Price:</label>
        <div class="col-sm-10">
          <div class="form-group" :class="{ 'has-warning': showError && wrongPrice }">
            <input id="number" name="number" class="form-control form-control-warning" type="text" v-model="product.price">
            <div class="form-control-feedback text-danger" v-if="showError && wrongPrice">This field is required & must be a number</div>
          </div>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <button type="submit" class="btn btn-success">Add Product</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      product: {
        name: '',
        price: '',
      },
      showError: false,
    };
  },
  computed: {
    missingName() {
      return this.product.name === "";
    },

    wrongPrice() {
      return (this.isNumeric(this.product.price) === false);
    },
  },
  methods: {
    isNumeric(n) {
      return !isNaN(parseFloat(n)) && isFinite(n);
    },

    validateForm(event) {
      this.showError = true;
      if (this.missingName || this.wrongPrice) {
        event.preventDefault();
      }
    },

    addProduct() {
      if (this.product.name != "" && this.product.price !="" && !this.wrongPrice) {
        this.showError = false;
      }
      alert("Add to the Product List!");
      this.$store.dispatch("addProduct", this.product);
      this.product.name = "";
      this.product.price = "";
      this.$store.dispatch("getAllProducts");
    },
  },
};
</script>
