<div class="form-group has-feedback @if ($errors->has('name')) has-error @endif">
    <label for="name">Name:</label>
    {{ html()->text('name')->id('name')->class('form-control')->placeholder('Name') }}
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'name'])
</div>
<div class="form-group has-feedback @if ($errors->has('email')) has-error @endif">
    <label for="email">Email:</label>
    {{ html()->email('email')->id('email')->class('form-control')->placeholder('Email') }}
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'email'])
</div>
<div class="form-group has-feedback @if ($errors->has('telephone')) has-error @endif">
    <label for="telephone">Telephone:</label>
    {{ html()->text('telephone')->id('telephone')->class('form-control')->placeholder('Telephone') }}
    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'telephone'])
</div>
<div class="form-group has-feedback @if ($errors->has('lead_time')) has-error @endif">
    <label for="lead_time">Lead Time: <small>(Days)</small></label>
    {{ html()->text('lead_time')->id('lead_time')->class('form-control')->placeholder('Lead Time') }}
    <span class="glyphicon glyphicon-road form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'lead_time'])
</div>
<div class="form-group has-feedback @if ($errors->has('address')) has-error @endif">
    <label for="address">Address:</label>
    {{ html()->text('address')->id('address')->class('form-control')->placeholder('Address') }}
    <span class="glyphicon glyphicon-road form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'address'])
</div>
<div class="form-group has-feedback @if ($errors->has('address_2')) has-error @endif">
    <label for="address_2">Secondary Address:</label>
    {{ html()->text('address_2')->id('address_2')->class('form-control')->placeholder('Secondary Address') }}
    <span class="glyphicon glyphicon-road form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'address_2'])
</div>
<div class="form-group has-feedback @if ($errors->has('city')) has-error @endif">
    <label for="city">City:</label>
    {{ html()->text('city')->id('city')->class('form-control')->placeholder('City') }}
    <span class="glyphicon glyphicon-home form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'city'])
</div>
<div class="form-group has-feedback @if ($errors->has('province')) has-error @endif">
    <label for="province">Province:</label>
    {{ html()->text('province')->id('province')->class('form-control')->placeholder('Province') }}
    <span class="glyphicon glyphicon-certificate form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'province'])
</div>
<div class="form-group has-feedback @if ($errors->has('country')) has-error @endif">
    <label for="country">Country:</label>
    {{ html()->text('country')->id('country')->class('form-control')->placeholder('Country') }}
    <span class="glyphicon glyphicon-globe form-control-feedback"></span>
    @include('errors._helpblock', ['field' => 'country'])
</div>
<div class="row">
    <div class="col-xs-12">
        @include('errors._block')
    </div>
</div>
