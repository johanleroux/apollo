<tr>
    <td class="mailbox-star"><i class="fa fa-star text-yellow"></i></td>
    <td class="mailbox-name">{{ $thread->creator()->name }}</td>
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
    <td class="mailbox-date">Last Reply: {{ $thread->latestMessage->created_at->diffForHumans() }}</td>
</tr>
