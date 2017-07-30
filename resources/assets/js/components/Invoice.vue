<template>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group has-feedback">
                <label for="supplier">Supplier:</label>
                <select name="supplier" id="supplier" class="form-control" v-model="supplier_id">
                    <option disabled selected value="">Select a Supplier</option>
                    <option v-for="option in suppliers" v-bind:value="option.id">{{ option.name }}</option>
                </select>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
        </div>
        <div class="col-md-6">
            <invoice-supplier :supplier="supplier"></invoice-supplier>
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
                    <invoice-row v-for="row in invoice_rows" :row="row"></invoice-row>
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
</template>

<script>
    export default {
        props: ['suppliers'],

        data: function () {
            return {
                supplier_id: '',
                supplier: '',
                invoice_rows: '',
                total: 0
            }
        },
        created: function() {
            this.reset();
        },
        methods: {
            reset: function () {
                // Reset Rows
                this.invoice_rows = [];
                this.createRow(1);
            },
            createRow: function() {
                this.invoice_rows.push(
                {
                    id: this.invoice_rows.length+1,
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
                this.invoice_rows.forEach(row => {
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
            invoice_rows: {
                handler: function()
                {
                    let emptyRows = this.invoice_rows.filter(row => (row.product.sku == ''));

                    if(emptyRows.length == 0)
                    this.createRow();
                },
                deep: true
            }
        }
    }
</script>
