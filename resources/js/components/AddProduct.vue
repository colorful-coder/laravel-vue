<template>
    <div class="col-sm-4 border border-success rounded" style="height:200px;">
        <form
            class="mt-3"
            action="./api/store"
            method="POST"
            @submit.prevent="addProduct()"
        >
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        v-model="product.name"
                        class="form-control"
                        id="name"
                        required
                    />
                    <div class="invalid-feedback">
                        Please select a valid state.
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label"
                    >Price:</label
                >
                <div class="col-sm-10">
                    <input
                        type="text"
                        v-model="product.price"
                        class="form-control"
                        id="price"
                        required
                    />
                    <div class="invalid-feedback">
                        Please select a valid state.
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <button type="submit" class="btn btn-success">
                    Add Product
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            product: []
        };
    },
    props: {
        addedProducts: ""
    },
    methods: {
        addProduct() {
            axios
                .post("./api/store", {
                    name: this.product.name,
                    price: this.product.price
                })
                .then(response => {
                    this.$emit("clickAdd");
                    this.product = "";
                })
                .catch(error => console.log(error));
        }
    }
};
</script>
