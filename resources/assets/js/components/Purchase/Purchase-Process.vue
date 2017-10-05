<template>
    <div class="modal fade" id="purchaseProcess" tabindex="-1" role="dialog" aria-labelledby="purchaseProcessLbl">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="purchaseProcessLbl">Purchase #{{purchase}}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group has-feedback" v-bind:class="{ 'has-error': errors.has('ext_invoice') }">
                        <label for="ext_invoice">Invoice #</label>
                        <input type="text" class="form-control" id="ext_invoice" placeholder="External Invoice #" v-model="ext_invoice">
                        <span class="help-block" v-text="errors.get('ext_invoice')"></span>
                    </div>
                    <div class="form-group has-feedback" v-bind:class="{ 'has-error': errors.has('ext_invoice') }">
                        <label for="ext_invoice">External Invoice</label>
                        <input type="text" class="form-control" id="ext_invoice" placeholder="External Invoice #" v-model="ext_invoice">
                        <span class="help-block" v-text="errors.get('ext_invoice')"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click.prevent="onSubmit">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {Errors} from '../../Errors'

export default {
    props: ['purchase'],

    data: function() {
        return {
            ext_invoice: '',
            errors: new Errors()
        }
    },
    computed: {
        request: function () {
            let data = new FormData();
            data.append('ext_invoice', this.ext_invoice);
            return data;
        }
    },
    methods: {
        onSubmit: function() {
            this.errors.clear();
            axios.post('/purchases/' + this.purchase + '/process', this.request)
            .then(response => window.location = response.request.response)
            .catch(error => {
                this.errors.record(error.response.data.errors);
            });
        }
    }
}
</script>
