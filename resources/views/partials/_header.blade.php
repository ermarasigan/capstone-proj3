{{-- HEADER PARTIAL --}}

<nav class="nav-extended cyan" role="navigation">
	<div class="container nav-wrapper">

    {{-- LOGO --}}
    <a id="logo-container" href="/" class="brand-logo left">
      <i class="material-icons left">directions_run</i>
      <b><i>ReadyToGov</i></b>
    </a>

    {{-- USER --}}
    <ul class="nav navbar-nav right">
      <!-- Authentication Links -->
      @if (Auth::guest())
        <li>
          <span class="hide-on-med-and-down">SIGN IN</span>
          <a href="{{ route('login') }}" class="btn btn-floating pulse cyan darken-2 tooltipped" data-position="left" data-delay="50" data-tooltip="Sign in!">
            <i class="material-icons left">account_box</i>
          </a>
        </li>
      @else
        <li class="dropdown">
          <!-- Dropdown Trigger -->
          <span class="hide-on-med-and-down">LOG OUT</span>
          <a class='dropdown-button btn-floating cyan darken-2 tooltipped' data-position="left" data-delay="50" data-tooltip="Log out!" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            <i class="material-icons right">exit_to_app</i>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </li>
      @endif {{-- Auth check --}}
    </ul>
  </div>
</nav>