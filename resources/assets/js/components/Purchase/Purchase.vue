<template>
    <form method="POST" @submit.prevent="onSubmit">
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
                            <th></th>
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
                            <td colspan="5"></td>
                            <td><input type="text" readonly class="form-control text-right" v-model="total"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <input class="btn btn-primary pull-right" type="submit" value="Save Purchase">
            </div>
        </div>
    </form>
</template>

<script>
import {Errors} from '../../Errors'

export default {
    props: ['suppliers', 'sup'],

    data: function () {
        return {
            supplier_id: '',
            supplier: '',
            purchase_rows: '',
            total: 0,
            errors: new Errors(),
            request: ''
        }
    },

    created: function() {
        if(this.purchases == undefined)
        {
            this.reset();
            if(this.sup != null)
                this.supplier_id = this.sup;
        } else {
            this.supplier_id = this.purchases.supplier_id;
            this.$nextTick(function () {
                this.purchase_rows = [];

                var i = 1;
                this.purchases.items.forEach(item => {
                    this.purchase_rows.push({
                        id: i,
                        product: {
                            sku: item.product_id,
                            description: '',
                            unit_price: '',
                            quantity: ''
                        }
                    });

                    i++;
                });

                this.$nextTick(function () {
                    for (var i = 1; i < this.purchase_rows.length - 1; i++) {
                        this.purchase_rows[i].product.description = 'reset';
                    }

                    var i = 0;
                    this.$nextTick(function () {
                        this.purchases.items.forEach(item => {
                            this.purchase_rows[i].product.quantity   = item.quantity;
                            this.purchase_rows[i].product.unit_price = item.price;

                            i++;
                        });
                    });
                });
            });
        }
    },

    methods: {
        onSubmit: function() {
            this.generateRequest();

            this.errors.clear();
            axios.post(this.url, this.request)
            .then(response => {
                window.location = response.request.response;
            })
            .catch(error => {
                this.errors.record(error.response.data);
            });
        },

        deleteRow: function(deleteRow) {
            var old_rows = this.purchase_rows;

            this.reset();

            var i = 1;
            old_rows.forEach(row => {
                if(row.id == deleteRow) return;

                this.purchase_rows[i-1] = {
                    id: i,
                    product: {
                        sku:         row.product.sku,
                        description: row.product.description,
                        unit_price:  row.product.unit_price,
                        quantity:    row.product.quantity
                    }
                };

                i++;
            });
        },

        reset: function () {
            // Reset Rows
            this.purchase_rows = [];
            this.createRow(1);
        },

        createRow: function() {
            this.purchase_rows.push({
                id: this.purchase_rows.length+1,
                product: {
                    sku: '',
                    description: '',
                    unit_price: '',
                    quantity: ''
                }
            })
        },

        calcTotal: function() {
            let total = 0;
            this.purchase_rows.forEach(row => {
                if(row.product.total != undefined)
                total += Number.parseFloat(row.product.total);
            });

            this.total = total.toFixed(2);
        },

        generateRequest: function () {
            let data = new FormData();
            data.append('supplier_id', this.supplier_id);
            if(this.isEdit())
                data.append('_method', 'patch');

            this.purchase_rows.forEach(row => {
                data.append('product[' + row.id + '][sku]', row.product.sku);
                data.append('product[' + row.id + '][unit_price]', row.product.unit_price);
                data.append('product[' + row.id + '][quantity]', row.product.quantity);
            });

            this.request = data;
        },

        isEdit: function() {
            return (this.purchases != undefined);
        }
    },
    computed: {
        products: function () {
            if(this.supplier == '') return;

            return this.supplier.products;
        },

        url: function () {
            if(!this.isEdit())
                return '/purchases';
            else
                return '/purchases/' + this.purchases.id;
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
