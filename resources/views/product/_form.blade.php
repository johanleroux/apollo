<div class="form-group has-feedback @if ($errors->has('sku')) has-error @endif">
    <label for="name">Sku:</label>
    {{ html()->text('sku')->id('sku')->class('form-control')->placeholder('Sku') }}
    <span class="glyphicon glyphicon-shopping-cart form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'sku'])
</div>
<div class="form-group has-feedback @if ($errors->has('description')) has-error @endif">
    <label for="description">Description:</label>
    {{ html()->text('description')->id('description')->class('form-control')->placeholder('Description') }}
    <span class="glyphicon glyphicon-info-sign form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'description'])
</div>
<div class="form-group has-feedback @if ($errors->has('price')) has-error @endif">
    <label for="price">Price:</label>
    {{ html()->text('price')->id('price')->class('form-control')->placeholder('Price') }}
    <span class="glyphicon glyphicon-usd form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'price'])
</div>
<div class="row">
    <div class="col-xs-12">
        @include('errors._block')
    </div>
</div>
