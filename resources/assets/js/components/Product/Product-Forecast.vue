<template>
    <div class="modal fade" id="manualForecast" tabindex="-1" role="dialog" aria-labelledby="purchaseProcessLbl">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="purchaseProcessLbl">Product {{product.sku}}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group has-feedback" v-bind:class="{ 'has-error': errors.has('adjusted_forecast') }">
                        <label for="adjusted_forecast">Adjusted Forecast</label>
                        <input type="text" class="form-control" id="adjusted_forecast" placeholder="Adjusted Forecast" v-model="adjusted_forecast">
                        <span class="help-block" v-text="errors.get('adjusted_forecast')"></span>
                    </div>
                    <div class="form-group has-feedback" v-bind:class="{ 'has-error': errors.has('year') }">
                        <label for="year">Year</label>
                        <select name="year" class="form-control" id="year" v-model="year">
                            <option value="2017" selected>2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2012">2012</option>
                        </select>

                        <span class="help-block" v-text="errors.get('year')"></span>
                    </div>
                    <div class="form-group has-feedback" v-bind:class="{ 'has-error': errors.has('month') }">
                        <label for="month">Month</label>
                        <select name="month" 
                                class="form-control"
                                id="month"
                                v-model="month">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                        </select>
                        <span class="help-block" v-text="errors.get('month')"></span>
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
    props: ['product'],

    data: function() {
        return {
            adjusted_forecast: '',
            year: '2017',
            month: 1,
            errors: new Errors()
        }
    },
    computed: {
        request: function () {
            let data = new FormData();
            data.append('adjusted_forecast', this.adjusted_forecast);
            data.append('year', this.year);
            data.append('month', this.month);
            return data;
        }
    },
    methods: {
        onSubmit: function() {
            this.errors.clear();

            axios.post('/products/' + this.product.id + '/forecast', this.request)
            .then(response => window.location = response.request.response)
            .catch(error => {
                this.errors.record(error.response.data);
            });
        }
    }
}
</script>
