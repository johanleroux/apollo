@if(isset($suppliers))
    <div class="form-group has-feedback @if ($errors->has('supplier_id')) has-error @endif">
        <label for="name">Supplier:</label>
        {{ html()->select('supplier_id', $suppliers)->id('supplier_id')->class('form-control')->placeholder('Select a Supplier') }}
        <span class="glyphicon glyphicon-shopping-cart form-control-feedback"></span>
        @include('errors._helpblock', ['field' => 'supplier_id'])
    </div>
@else
    <div class="form-group has-feedback @if ($errors->has('supplier_id')) has-error @endif">
        <label for="name">Supplier:</label>
        {{ html()->text('supplier_id')->id('supplier_id')->class('form-control')->placeholder('Supplier')->value($product->supplier->name) }}
        <span class="glyphicon glyphicon-shopping-cart form-control-feedback"></span>
        @include('errors._helpblock', ['field' => 'supplier_id'])
    </div>
@endif
<div class="form-group has-feedback @if ($errors->has('sku')) has-error @endif">
    <label for="name">SKU:</label>
    {{ html()->text('sku')->id('sku')->class('form-control')->placeholder('SKU') }}
    <span class="glyphicon glyphicon-shopping-cart form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'sku'])
</div>
<div class="form-group has-feedback @if ($errors->has('description')) has-error @endif">
    <label for="description">Description:</label>
    {{ html()->text('description')->id('description')->class('form-control')->placeholder('Description') }}
    <span class="glyphicon glyphicon-info-sign form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'description'])
</div>
<div class="form-group has-feedback @if ($errors->has('cost_price')) has-error @endif">
    <label for="cost_price">Cost Price:</label>
    {{ html()->text('cost_price')->id('cost_price')->class('form-control')->placeholder('Price') }}
    <span class="glyphicon glyphicon-usd form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'cost_price'])
</div>
<div class="form-group has-feedback @if ($errors->has('retail_price')) has-error @endif">
    <label for="retail_price">Retail Price:</label>
    {{ html()->text('retail_price')->id('retail_price')->class('form-control')->placeholder('Price') }}
    <span class="glyphicon glyphicon-usd form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'retail_price'])
</div>
<div class="form-group has-feedback @if ($errors->has('recommended_selling_price')) has-error @endif">
    <label for="recommended_selling_price">Recommended Selling Price:</label>
    {{ html()->text('recommended_selling_price')->id('recommended_selling_price')->class('form-control')->placeholder('Price') }}
    <span class="glyphicon glyphicon-usd form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'recommended_selling_price'])
</div>
