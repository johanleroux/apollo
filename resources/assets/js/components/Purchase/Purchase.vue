<template>
    <form method="POST" action="/purchases" @submit.prevent="onSubmit">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group has-feedback" v-bind:class="{ 'has-error': errors.has('supplier_id') }">
                    <label for="supplier">Supplier:</label>
                    <select name="supplier" id="supplier" class="form-control" v-model="supplier_id">
                        <option disabled selected value="">Select a Supplier</option>
                        <option v-for="option in suppliers" v-bind:value="option.id">{{ option.name }}</option>
                    </select>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <span class="help-block" v-text="errors.get('supplier_id')"></span>
                </div>
            </div>
            <div class="col-md-6">
                <purchase-supplier :supplier="supplier"></purchase-supplier>
            </div>
            <div class="col-md-12">
                <hr>
                <table class="table table-condensed">
                    <thead>

                        <tr>
                            <th>SKU</th>
                            <th>Description</th>
                            <th class="text-right">Unit Price</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <purchase-row v-for="row in purchase_rows" :row="row"></purchase-row>
                        <tr>
                            <td colspan="4"></td>
                            <td><input type="text" class="form-control text-right" v-model="total"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <input class="btn btn-primary pull-right" type="submit" value="Create Purchase">
            </div>
        </div>
    </form>
</template>

<script>
import {Errors} from '../../Errors'

export default {
    props: ['suppliers'],

    data: function () {
        return {
            supplier_id: '',
            supplier: '',
            purchase_rows: '',
            total: 0,
            errors: new Errors()
        }
    },
    created: function() {
        this.reset();
    },
    methods: {
        onSubmit: function() {
            this.errors.clear();
            axios.post('/purchases', this.request)
            .then(response => window.location = response.request.response)
            .catch(error => {
                this.errors.record(error.response.data);
            });
        },
        reset: function () {
            // Reset Rows
            this.purchase_rows = [];
            this.createRow(1);
        },
        createRow: function() {
            this.purchase_rows.push(
            {
                id: this.purchase_rows.length+1,
                product: {
                    sku: '',
                    description: '',
                    unit_price: '',
                    quantity: ''
                }
            }
            )
        },
        calcTotal: function() {
            let total = 0;
            this.purchase_rows.forEach(row => {
                if(row.product.total != undefined)
                total += Number.parseFloat(row.product.total);
            });

            this.total = total.toFixed(2);
        }
    },
    computed: {
        products: function () {
            if(this.supplier == '') return;

            return this.supplier.products;
        },
        request: function () {
            let data = new FormData();
            data.append('supplier_id', this.supplier_id);

            this.purchase_rows.forEach(row => {
                data.append('product[' + row.id + '][sku]', row.product.sku);
                data.append('product[' + row.id + '][unit_price]', row.product.unit_price);
                data.append('product[' + row.id + '][quantity]', row.product.quantity);
            });

            return data;
        }
    },
    watch: {
        supplier_id: function () {
            if(this.supplier_id == '') return;

            // Reset Rows
            this.reset();

            // Set Supplier
            this.supplier = this.suppliers.find(supplier => this.supplier_id == supplier.id);
        },
        purchase_rows: {
            handler: function()
            {
                let emptyRows = this.purchase_rows.filter(row => (row.product.sku == ''));

                if(emptyRows.length == 0)
                this.createRow();
            },
            deep: true
        }
    }
}
</script>
