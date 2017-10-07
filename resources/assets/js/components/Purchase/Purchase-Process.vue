<template>
    <div class="modal fade" id="purchaseProcess" tabindex="-1" role="dialog" aria-labelledby="purchaseProcessLbl">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="purchaseProcessLbl">Purchase #{{purchase}}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group has-feedback" v-bind:class="{ 'has-error': errors.has('ext_invoice_number') }">
                        <label for="ext_invoice_number">Invoice #</label>
                        <input type="text" class="form-control" id="ext_invoice_number" placeholder="External Invoice #" v-model="ext_invoice_number">
                        <span class="help-block" v-text="errors.get('ext_invoice_number')"></span>
                    </div>
                    <div class="form-group has-feedback" v-bind:class="{ 'has-error': errors.has('ext_invoice_image') }">
                        <label for="ext_invoice_image">External Invoice</label>
                        <input type="file" class="form-control" id="ext_invoice_image">
                        <span class="help-block" v-text="errors.get('ext_invoice_image')"></span>
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
import {
    Errors
} from '../../Errors'

export default {
    props: ['purchase'],

    data: function () {
        return {
            ext_invoice_number: '',
            errors: new Errors(),
            formData: new FormData(),
        }
    },
    methods: {
        onSubmit: function () {
            this.errors.clear();
            this.formData.append('ext_invoice_number', this.ext_invoice_number);
            this.formData.append('ext_invoice_image', document.getElementById('ext_invoice_image').files[0]);

            axios.post('/purchases/' + this.purchase + '/process', this.formData, {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                })
                .then(response => window.location = response.request.response)
                .catch(error => {
                    this.errors.record(error.response.data.errors);
                });
        }
    }
}
</script>
