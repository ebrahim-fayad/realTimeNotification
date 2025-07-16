<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>

    <ul class="nav">

        <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2 readNotification" href="./#" data-toggle="modal" data-target=".modal-notif">
                <span class="fe fe-bell fe-16"></span>
                <span class="dot dot-md text-danger" id ="nCounter"><strong class="text-danger">  {{ $admin->unreadnotifications->count() }}</strong></span>
            </a>
        </li>
      <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="dark">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>

        {{-- Notification Modal --}}
        <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="nContent">
                        <div class="list-group list-group-flush my-n3">
                            @forelse ($admin->notifications as $notify)
                                 
                            <div class="list-group-item {{ $notify->read_at == null ? 'bg-light' : 'bg-transparent' }}">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="fe fe-box fe-24"></span>
                                    </div>
                                    <div class="col">
                                        <small><strong>New User Registerd </strong></small>
                                        <div class="my-0 text-muted small">{{ $notify->data['message'] }}</div>
                                        <small class="badge badge-pill badge-light text-muted">{{ $notify->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                           @empty
                             there is no notification for displaying it
                            @endforelse
                        </div> <!-- / .list-group -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" id="clearNotification">Clear
                            All</button>
                    </div>
                </div>
            </div>
        </div>






        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <img src="{{ asset('assets') }}/images/avatar.png" alt="Profile image"
                        class="avatar-img rounded-circle">
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                <form action="{{ route('admin.logout') }}" method="POST" class="dropdown-item">
                    @csrf
                    <button type="submit" class="border-0 bg-transparent p-0 text-danger">
                        <span key="t-logout">{{ __('lang.logout') }}</span>
                    </button>
                </form>

            </div>
        </li>

    </ul>
</nav>