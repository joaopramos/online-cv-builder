<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
        ng-init="isCollapsed = true" ng-click="isCollapsed = !isCollapsed"
        data-target="#navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{URL::to('/')}}">Online CV</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1"
        ng-class="!isCollapsed && 'in'">
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::check())
        <li class='dropdown' dropdown>
            <a class='dropdown-toggle' dropdown-toggle data-toggle='dropdown' href='#'>
                <span class='fa fa-user'></span>
                {{ Auth::user()->email }} <span class='caret'></span>
            </a>
            <ul class='dropdown-menu' role='menu'>
                <li><a href="{{URL::to('/')}}"> cv </a></li>
                <li><a href="{{URL::to('/profile')}}"> profile </a></li>
                <li><a href="{{URL::to('/pdf')}}"> download pdf </a></li>
                <li><a href="{{URL::to('/auth/logout/')}}">Logout</a></li>
             </ul>
        </li>
        @else
        <li><a href="{{URL::to('/auth/login')}}">Login</a></li>
        <li><a href="{{URL::to('/auth/register')}}">Register</a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div>
</nav>
