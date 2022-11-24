<div class="col-auto col-md-3 col-xl-2  px-0 left_bar">
    <div class="d-flex flex-column align-items-center align-items-sm-start  pt-2 text-white min-vh-100 left_fix">
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <ul class="nav nav-list">

                @if(Auth::user()->role_id == "1")

                <li class="{{ Request::path() ==  'dashboard' ? 'nav-item' : ''  }}">
                    <a href="{{ url('/dashboard') }}" class="nav-link align-middle">
                        <img src="{{ asset('theme/assets/images/dashboard-new.svg') }}" alt="clarity">
                        <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role_id == "2")
                <li class="{{ Request::path() ==  'dashboard' ? 'nav-item' : ''  }}">
                    <a href="{{ url('/dashboard') }}" class="nav-link align-middle">
                        <img src="{{ asset('theme/assets/images/clarity_dashboard-line.svg') }}" alt="clarity">
                        <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                    </a>
                </li>
                @if( Request::path() == 'coach-index')
                <li class="{{ Request::path() ==  'coach-index' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'coach-view')
                <li class="{{ Request::path() ==  'coach-view' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'coach-edit')
                <li class="{{ Request::path() ==  'coach-edit' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'coach-add-form')
                <li class="{{ Request::path() ==  'coach-add-form' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'coach-existing')
                <li class="{{ Request::path() ==  'coach-existing' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'assign-player')
                <li class="{{ Request::path() ==  'assign-player' ? 'nav-item' : ''  }}">
                    @else
                <li class="{{ Request::path() ==  'coach-view' ? 'nav-item' : ''  }}">
                    @endif
                    <a href="{{ url('/coach-index') }}" class="nav-link align-middle">
                        <img src="{{ asset('theme/assets/images/coach-m.svg') }}" alt="coach">
                        <span class="ms-1 d-none d-sm-inline">Coach Management</span>
                    </a>
                </li>
                <li class="{{ Request::path() ==  'archive-coach' ? 'nav-item' : ''  }}">
                    <a href="{{ url('/archive-coach') }}" class="nav-link align-middle ">
                        <img src="{{ asset('theme/assets/images/play-m.svg') }}" alt="play">
                        <span class="ms-1 d-none d-sm-inline">Archive Coaches</span></a>
                </li>
                @if( Request::path() == 'player-index')
                <li class="{{ Request::path() ==  'player-index' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'player-view')
                <li class="{{ Request::path() ==  'player-view' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'player-edit')
                <li class="{{ Request::path() ==  'player-edit' ? 'nav-item' : ''  }}">
                    @else
                <li class="{{ Request::path() ==  'player-index' ? 'nav-item' : ''  }}">
                    @endif
                    <a href="{{ url('/player-index') }}" class="nav-link align-middle ">
                        <img src="{{ asset('theme/assets/images/Playr.svg') }}" alt="play">
                        <span class="ms-1 d-none d-sm-inline">Player Management</span></a>
                </li>
                <li class="{{ Request::path() ==  'archive-index' ? 'nav-item' : ''  }}">
                    <a href="{{ url('/archive-index') }}" class="nav-link align-middle ">
                        <img src="{{ asset('theme/assets/images/play-m.svg') }}" alt="play">
                        <span class="ms-1 d-none d-sm-inline">Archive Players</span></a>
                </li>
                @endif
              


                @if(Auth::user()->role_id == "1")
                @if( Request::path() == 'player-index')
                <li class="{{ Request::path() ==  'player-index' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'player-view')
                <li class="{{ Request::path() ==  'player-view' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'player-edit')
                <li class="{{ Request::path() ==  'player-edit' ? 'nav-item' : ''  }}">
                    @else
                <li class="{{ Request::path() ==  'player-index' ? 'nav-item' : ''  }}">
                    @endif
                    <a href="{{ url('/player-index') }}" class="nav-link align-middle ">
                        <img src="{{ asset('theme/assets/images/players.svg') }}" alt="play">
                        <span class="ms-1 d-none d-sm-inline">Player Management</span></a>
                </li>

                <li class="{{ Request::path() ==  'archive-index' ? 'nav-item' : ''  }}">
                    <a href="{{ url('/archive-index') }}" class="nav-link align-middle ">
                        <img src="{{ asset('theme/assets/images/coaching.svg') }}" alt="play">
                        <span class="ms-1 d-none d-sm-inline">Archive Players</span></a>
                </li>
                @if( Request::path() == 'club-info-index')
                <li class="{{ Request::path() ==  'club-info-index' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'club-info-add')
                <li class="{{ Request::path() ==  'club-info-add' ? 'nav-item' : ''  }}">
                @elseif( Request::path() == 'club-info-view')
                <li class="{{ Request::path() ==  'club-info-view' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'club-info-edit')
                <li class="{{ Request::path() ==  'club-info-edit' ? 'nav-item' : ''  }}">
                    @else
                <li class="{{ Request::path() ==  'club-info-index' ? 'nav-item' : ''  }}">
                    @endif
                    <a href="{{ url('/club-info-index') }}" class="nav-link align-middle">
                        <img src="{{ asset('theme/assets/images/management.svg') }}" alt="group">
                        <span class="ms-1 d-none d-sm-inline">Club Management</span></a>
                </li>

                @if( Request::path() == 'club-index')
                <li class="{{ Request::path() ==  'club-index' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'club-add')
                <li class="{{ Request::path() ==  'club-add' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'club-edit')
                <li class="{{ Request::path() ==  'club-edit' ? 'nav-item' : ''  }}">
                    @else
                <li class="{{ Request::path() ==  'club-index' ? 'nav-item' : ''  }}">
                    @endif
                    <a href="{{ url('/club-index') }}" class="nav-link align-middle">
                        <img src="{{ asset('theme/assets/images/management.svg') }}" alt="group">
                        <span class="ms-1 d-none d-sm-inline">Club Admin</span></a>
                </li>
                <li>
                    <a href="{{ url('/logout-user') }}" class="nav-link align-middle">
                        <img src="{{ asset('theme/assets/images/design_logout.svg') }}" alt="ant">
                        <span class="ms-1 d-none d-sm-inline">Logout</span> </a>
                </li>


                <!--              
                <li class="{{ Request::path() ==  'contact-reason-index' ? 'nav-item' : ''  }}">
                    <a href="{{ url('/contact-reason-index') }}" class="nav-link align-middle">
                        <img src="{{ asset('theme/assets/images/bx_help-circle.svg') }}" alt="help">
                        <span class="ms-1 d-none d-sm-inline">Help/Contact Us</span> </a>
                </li> -->
                <!--     <li class="{{ Request::path() ==  'chat-home' ? 'nav-item' : ''  }}">
                    <a href="{{ url('/chat-home') }}" class="nav-link align-middle">
                        <img src="{{ asset('theme/assets/images/bx_help-circle.svg') }}" alt="help">
                        <span class="ms-1 d-none d-sm-inline">Chat</span> </a>
                </li>-->
                @endif
                @if(Auth::user()->role_id == "2")
                @if( Request::path() == 'event-index')
                <li class="{{ Request::path() ==  'event-index' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'event-add')
                <li class="{{ Request::path() ==  'event-add' ? 'nav-item' : ''  }}">
                    @else
                <li class="{{ Request::path() ==  'event-index' ? 'nav-item' : ''  }}">
                    @endif
                    <a href="{{ url('/event-index') }}" class="nav-link align-middle">
                        <img src="{{ asset('theme/assets/images/Calendar.svg') }}" alt="group">
                        <span class="ms-1 d-none d-sm-inline">Event Management</span></a>
                </li>
                @if( Request::path() == 'team-index')
                <li class="{{ Request::path() ==  'team-index' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'team-view')
                <li class="{{ Request::path() ==  'team-view' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'team-edit')
                <li class="{{ Request::path() ==  'team-edit' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'team-add')
                <li class="{{ Request::path() ==  'team-add' ? 'nav-item' : ''  }}">
                    @else
                <li class="{{ Request::path() ==  'team-player' ? 'nav-item' : ''  }}">
                    @endif
                    <a href="{{ url('/team-index') }}" class="nav-link align-middle">
                        <img src="{{ asset('theme/assets/images/coach-m.svg') }}" alt="coach">
                        <span class="ms-1 d-none d-sm-inline">Team</span>
                    </a>
                </li>
                @if( Request::path() == 'club-notes-index')
                <li class="{{ Request::path() ==  'club-notes-index' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'club-notes-view')
                <li class="{{ Request::path() ==  'club-notes-view' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'club-notes-edit')
                <li class="{{ Request::path() ==  'club-notes-edit' ? 'nav-item' : ''  }}">
                    @elseif( Request::path() == 'club-notes-add')
                <li class="{{ Request::path() ==  'club-notes-add' ? 'nav-item' : ''  }}">
                    @else
                <li class="{{ Request::path() ==  'club-notes-player' ? 'nav-item' : ''  }}">
                    @endif
                    <a href="{{ url('/club-notes-index') }}" class="nav-link align-middle">
                        <img src="{{ asset('theme/assets/images/coach-m.svg') }}" alt="coach">
                        <span class="ms-1 d-none d-sm-inline">Notes</span>
                    </a>
                </li>
                <li class="{{ Request::path() ==  'chat-home' ? 'nav-item' : ''  }}">
                    <a href="{{ url('/chat-home') }}" class="nav-link align-middle">
                        <img src="{{ asset('theme/assets/images/bx_help-circle.svg') }}" alt="help">
                        <span class="ms-1 d-none d-sm-inline">Chat</span> </a>
                </li>
                <li>
                    <a href="{{ url('/logout-user') }}" class="nav-link align-middle">
                        <img src="{{ asset('theme/assets/images/ant-design_logout-outlined.svg') }}" alt="ant">
                        <span class="ms-1 d-none d-sm-inline">Logout</span> </a>
                </li>

                @endif


            </ul>
        </ul>

    </div>
</div>