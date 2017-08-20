<header class="main-header">
    <a href="{{ url('/') }}" class="logo">
        <span class="logo-mini"><b>A</b></span>
        <span class="logo-lg"><b>Apollo</b></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        @if(auth()->user()->newThreadsCount() > 0)
                            <span class="label label-success">{{ auth()->user()->newThreadsCount() }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{ auth()->user()->newThreadsCount() }} new {{ str_plural('message', auth()->user()->newThreadsCount()) }}</li>
                        @if(isset($share_threads))
                            <li>
                                <ul class="menu">
                                    @foreach($share_threads as $thread)
                                        <li>
                                            <a href="{{ action('MessagesController@show', $thread->id) }}">
                                                <div class="pull-left"><img src="{{ asset('img/avatar.png') }}" class="img-circle" alt="User Image"></div>
                                                @if($thread->isUnread(Auth::id()))
                                                    <h4><b>{{ $thread->subject }}</b><small><i class="fa fa-clock-o"></i> {{ $thread->latestMessage->created_at->diffForHumans() }}</small></h4>
                                                @else
                                                    <h4>{{ $thread->subject }}<small><i class="fa fa-clock-o"></i> {{ $thread->latestMessage->created_at->diffForHumans() }}</small></h4>
                                                @endif
                                                <p>by {{ $thread->creator()->name }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        <li class="footer"><a href="{{ action('MessagesController@index') }}">See All Messages</a></li>
                    </ul>
                </li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        @if(auth()->user()->unreadNotifications()->count() > 0)
                            <span class="label label-warning">{{ auth()->user()->unreadNotifications()->count() }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{ auth()->user()->unreadNotifications()->count() }} unread notifications</li>
                        <li>
                            <ul class="menu">
                                @foreach(auth()->user()->unreadNotifications as $notification)
                                <li>
                                    <a href="{{ action('NotificationsController@show', $notification) }}"><i class="fa fa-users text-red"></i> {{ $notification->data['message'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer"><a href="{{ action('NotificationsController@index') }}">Remove all</a></li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('img/avatar.png') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu" style="width: 50%">
                        <li>
                            <a href="{{ url('settings') }}"><i class="fa fa-gears"></i>Settings</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i>Sign Out</a>
                            {{ html()->form('POST', route('logout'))->id('logout-form')->open() }}{{ html()->form()->close() }}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
