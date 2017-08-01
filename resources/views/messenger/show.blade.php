@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('message_show', $thread) !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="{{ asset('img/avatar.png') }}" alt="User Image">
                        <span class="username"><a href="#">{{ $thread->subject }}</a></span>
                        <span class="description">{{ $thread->messages->first()->created_at }}</span>
                    </div>
                </div>
                <div class="box-footer box-comments">
                    @foreach($thread->messages as $message)
                        @if($message->user->id == auth()->user()->id)
                            <div class="box-comment">
                                <img class="img-circle img-sm" src="{{ asset('img/avatar.png') }}" alt="User Image">
                                <div class="comment-text">
                                    <span class="username">
                                        {{ $message->user->name }}
                                        <span class="text-muted pull-right">{{ $message->created_at }}</span>
                                    </span>
                                    {{ $message->body }}
                                </div>
                            </div>
                        @else
                            <div class="box-comment">
                                <img class="img-circle img-sm pull-right" src="{{ asset('img/avatar.png') }}" alt="User Image">
                                <div class="comment-text" style="margin-left: 0px; margin-right: 40px">
                                    <span class="username">
                                        <span class="text-muted">{{ $message->created_at }}</span>
                                        <span class="pull-right">{{ $message->user->name }}</span>
                                    </span>
                                    <span class="pull-right">
                                        {{ $message->body }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="box-footer">
                    {{ html()->form('PUT', action('MessagesController@update', $thread->id))->open() }}
                    <div class="form-group @if ($errors->has('message')) has-error @endif">
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
@endsection
