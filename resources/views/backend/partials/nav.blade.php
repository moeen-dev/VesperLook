<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link nav-link-lg message-toggle {{ Auth::user()->notifications->sortByDesc('created_at')->take(3)->filter(fn($n) => is_null($n->read_at))->count() > 0 ? 'beep' : '' }}"><i
                    class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notification
                    <div class="float-right">
                        {{-- <a href="#">Mark All As Read</a> --}}
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-message">

                    @foreach(Auth::user()->notifications->sortByDesc('created_at')->take(3) as $notification)
                    <a href="{{ route('notification.show', $notification->id) }}"
                        class="dropdown-item {{ is_null($notification->read_at) ? 'dropdown-item-unread' : '' }}">

                        <div class="dropdown-item-avatar">
                            @if($notification->data['data']['user_image'])
                            <img alt="image" src="{{ url('upload/images', $notification->data['data']['user_image']) }}"
                                class="rounded-circle"
                                alt="{{ $notification->data['data']['user_name']}}_profile_image">
                            @else
                            <img alt="image" src="{{ url('assets/backend/assets/img/avatar/avatar-1.png') }}"
                                class="rounded-circle" alt="no_profile_image">
                            @endif
                        </div>

                        <div class="dropdown-item-desc">
                            <b>Order Received</b>
                            <p>Order #{{ $notification->data['data']['order_id'] ?? '' }} placed by {{
                                $notification->data['data']['user_name'] ?? '' }}</p>
                            <div class="time">{{ $notification->created_at->diffForHumans() }}</div>
                        </div>
                        
                    </a>
                    @endforeach
                </div>
                <div class="dropdown-footer text-center">
                    <a href="{{ route('orders.index') }}">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        <!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    <a href="#" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-icon bg-primary text-white">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Template update is available now!
                            <div class="time text-primary">2 Min Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-info text-white">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                            <div class="time">10 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-success text-white">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                            <div class="time">12 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-danger text-white">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Low disk space. Let's clean it!
                            <div class="time">17 Hours Ago</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="dropdown-item-icon bg-info text-white">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Welcome to Stisla template!
                            <div class="time">Yesterday</div>
                        </div>
                    </a>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li> -->
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if(Auth::user()->image)
                <img src="{{ url('upload/images', Auth::user()->image) }}" class="rounded-circle mr-1" alt="{{ Auth::user()->name}}_profile_image">
                @else
                <img src="{{ url('assets/backend/assets/img/avatar/avatar-1.png') }}" alt="{{ Auth::user()->name}}_profile_avatar">
                @endif
                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title"> @if(session('login_time'))
                    Logged in {{ \Carbon\Carbon::parse(session('login_time'))->diffForHumans() }}
                    @else
                    Logged in now
                    @endif
                </div>
                <a href="features-profile.html" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="features-activities.html" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Activities
                </a>
                <a href="{{ route('admin.setting.index') }}" class="dropdown-item has-icon {{ Route::is('admin.setting.index') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form action="{{ route('logout') }}" id="logout-form" class="d-done" method="POST">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>