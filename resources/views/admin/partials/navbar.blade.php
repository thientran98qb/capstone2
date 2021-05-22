<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <a href="{!! route('user.change-language', ['en']) !!}">English</a>
        <a href="{!! route('user.change-language', ['vi']) !!}">Vietnam</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge">
            @php
            $unReadNotification = DB::table('notifications')->where('notifiable_id', Auth::user()->id)->where('read_at', NULL)->get();
            $numberOfUnReadNotification = count($unReadNotification);
            @endphp
            <span id="noticenumberOfUnReadNotification" class="caret txt @if ($numberOfUnReadNotification<=0) hidden
                    @endif"><span id="numberOfUnReadNotification">{{$numberOfUnReadNotification}}</span></span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="list_notifications">
            @foreach (Auth::user()->notifications as $notification)
                <div id="noti{{$notification->id}}">
                    <a href="http://127.0.0.1:8000/admin/orders" class="dropdown-item  @if (!$notification->read_at)
                        bg-secondary text-white
                    @endif">
                        <!-- Message Start -->
                        <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{ $notification->data['title'] }}
                            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">{{ $notification->data['content'] }}</p>
                            <p class="text-sm text-muted @if (!$notification->read_at)
                                text-white
                            @endif"><i class="far fa-clock mr-1"></i>    {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}
                            </p>
                        </div>

                        </div>
                        @if (!$notification->read_at)
                        <a class="float-right" href="" data-id={{$notification->id}} data-user = "8" onClick="markAsRead(this)">
                            markAsRead
                        </a>
                        @endif
                        <!-- Message End -->
                    </a>

                </div>

                <div class="dropdown-divider"></div>
          @endforeach
          <a href="#" class="dropdown-item dropdown-footer" data-user = "8" onClick="markAllAsRead(this)">MarkAllAsRead</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
