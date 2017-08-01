@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('message_create') !!}
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Send a Message</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {{ html()->form('POST', action('MessagesController@store'))->open() }}
                    <div class="form-group has-feedback @if ($errors->has('recipients.*')) has-error @endif">
                        <label for="name">Recipients:</label>
                        {{ html()->select('recipients[]', $recipients)->id('recipients')->class('form-control')->attribute('multiple') }}
                        <span class="glyphicon glyphicon-shopping-cart form-control-feedback"></span>
                        @include('errors._helpblock', ['field' => 'recipients.*'])
                    </div>

                    <div class="form-group @if ($errors->has('subject')) has-error @endif">
                        <label for="subject">Subject:</label>
                        {{ html()->text('subject')->id('subject')->class('form-control')->placeholder('Subject') }}
                        @include('errors._helpblock', ['field' => 'subject'])
                    </div>

                    <div class="form-group @if ($errors->has('message')) has-error @endif">
                        <label for="message">Message:</label>
                        {{ html()->textarea('message')->id('message')->class('form-control')->placeholder('Message') }}
                        @include('errors._helpblock', ['field' => 'message'])
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control">Send Message</button>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
