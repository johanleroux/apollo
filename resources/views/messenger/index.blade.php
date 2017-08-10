@extends('layouts.backend')
@section('content-header')
    {!! Breadcrumbs::render('message') !!}

    <div class="btn-group pull-right">
      <a href="{{ action('MessagesController@create') }}" class="btn btn-sm">Compose</a>
    </div>
@endsection

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Messages</h3>
        </div>
        <div class="box-body no-padding">
            <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                    <tbody>
                        @forelse ($threads as $thread)
                            <tr>
                                <td class="mailbox-star" width="30px"><i class="fa fa-star text-yellow"></i></td>
                                <td class="mailbox-name" width="200px">{{ $thread->creator()->name }}</td>
                                <td class="mailbox-subject">
                                    <a href="{{ action('MessagesController@show', $thread->id) }}">
                                        @if($thread->isUnread(Auth::id()))
                                            <b>{{ $thread->subject }}({{ $thread->userUnreadMessagesCount(Auth::id()) }})</b>
                                        @else
                                            {{ $thread->subject }}
                                        @endif
                                    </a>
                                    - {{ $thread->messages->first()->body }}
                                </td>
                                <td class="mailbox-date" width="225px">Last Reply: {{ $thread->latestMessage->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No messages for you. <a href="{{ action('MessagesController@create') }}">Compose a Message</a></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
