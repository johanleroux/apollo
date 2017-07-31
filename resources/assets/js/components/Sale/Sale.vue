<template>
    <form method="POST" action="/sales" @submit.prevent="onSubmit">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group has-feedback" v-bind:class="{ 'has-error': errors.has('customer_id') }">
                    <label for="customer">Customer:</label>
                    <select name="customer" id="customer" class="form-control" v-model="customer_id">
                        <option disabled selected value="">Select a Customer</option>
                        <option v-for="option in customers" v-bind:value="option.id">{{ option.name }}</option>
                    </select>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <span class="help-block" v-text="errors.get('customer_id')"></span>
                </div>
            </div>
            <div class="col-md-6">
                <sale-customer :customer="customer"></sale-customer>
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
                        <sale-row v-for="row in sale_rows" :row="row"></sale-row>
                        <tr>
                            <td colspan="4"></td>
                            <td><input type="text" class="form-control text-right" v-model="total"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <input class="btn btn-primary pull-right" type="submit" value="Create Sale">
            </div>
        </div>
    </form>
</template>

<script>
import {Errors} from '../../Errors'

export default {
    props: ['customers', 'products'],

    data: function () {
        return {
            customer_id: '',
            customer: '',
            sale_rows: '',
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
            axios.post('/sales', this.request)
            .then(response => window.location = response.request.response)
            .catch(error => {
                this.errors.record(error.response.data);
            });
        },
        reset: function () {
            // Reset Rows
            this.sale_rows = [];
            this.createRow(1);
        },
        createRow: function() {
            this.sale_rows.push(
            {
                id: this.sale_rows.length+1,
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
            this.sale_rows.forEach(row => {
                if(row.product.total != undefined)
                total += Number.parseFloat(row.product.total);
            });

            this.total = total.toFixed(2);
        }
    },
    computed: {
        request: function () {
            let data = new FormData();
            data.append('customer_id', this.customer_id);

            this.sale_rows.forEach(row => {
                data.append('product[' + row.id + '][sku]', row.product.sku);
                data.append('product[' + row.id + '][unit_price]', row.product.unit_price);
                data.append('product[' + row.id + '][quantity]', row.product.quantity);
            });

            return data;
        }
    },
    watch: {
        customer_id: function () {
            if(this.customer_id == '') return;

            // Set Customer
            this.customer = this.customers.find(customer => this.customer_id == customer.id);
        },
        sale_rows: {
            handler: function()
            {
                let emptyRows = this.sale_rows.filter(row => (row.product.sku == ''));

                if(emptyRows.length == 0)
                this.createRow();
            },
            deep: true
        }
    }
}
</script>
