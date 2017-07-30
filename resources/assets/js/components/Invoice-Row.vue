<template>
    <tr>
        <td>
            <select name="sku" id="sku" class="form-control" v-model="row.product.sku">
                <option disabled selected value="" v-if="!this.$parent.supplier.products">No Products Available</option>
                <option disabled selected value="" v-if="this.$parent.supplier.products">Select a Product</option>
                <option v-for="option in this.$parent.supplier.products" v-bind:value="option.sku">{{ option.sku }}</option>
            </select>
        </td>
        <td><input type="text" name="description" id="description" placeholder="Description" class="form-control" v-model="row.product.description" /></td>
        <td><input type="text" name="unit_price" id="unit_price" placeholder="Unit Price" class="form-control text-right" v-model="row.product.unit_price" /></td>
        <td><input type="text" name="quantity" id="quantity" placeholder="Quantity" class="form-control text-right" v-model="row.product.quantity" /></td>
        <td><input type="text" name="total" id="total" placeholder="Total" class="form-control text-right" v-model="row.product.total" /></td>
    </tr>
</template>

<script>
export default {
    props: ['row'],
    data: function() {
        return {
            sku: ''
        }
    },
    watch: {
        row: {
            handler: function(newRow) {
                if(this.sku != newRow.product.sku)
                {
                    this.sku = newRow.product.sku;

                    let product = this.$parent.supplier.products.find(product => product.sku == this.sku);
                    if(product === undefined) return;

                    this.row.product.description = product.description;
                    this.row.product.unit_price = product.cost_price;
                    this.row.product.quantity = 1;
                }

                this.row.product.total = (this.row.product.unit_price * this.row.product.quantity).toFixed(2);

                this.$parent.calcTotal();
            },
            deep: true
        }
    }
}
</script>
