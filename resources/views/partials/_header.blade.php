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
          <a href="{{ route('login') }}">
            <i class="material-icons left">account_box</i>
            <span class="hide-on-med-and-down">Login</span>
          </a>
        </li>
        <li>
          <a href="{{ route('register') }} ">
            <i class="material-icons left">person_add</i>
            <span class="hide-on-med-and-down">Register</span>
          </a>
        </li>
      @else
        <li class="dropdown">
          <!-- Dropdown Trigger -->
          <a class='dropdown-button' href='#' data-activates='drop' data-beloworigin='true'>
            {{ Auth::user()->name }}
            <i class="material-icons right">arrow_drop_down</i>
          </a>

            <!-- Dropdown Structure -->
            <ul id='drop' class='dropdown-content' >
              <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form></li>
            </ul>
          </li>
        @endif
    </ul>

    <!-- Dropdown Trigger -->
          <a class='dropdown-button right hide-on-med-and-up' href='#' data-activates='usernav' data-beloworigin='true'>
            <i class="material-icons">menu</i>
          </a>
    
  {{-- <div class="light-teal container"> --}}

{{--   <div class="nav-content right-align">
      <ul class="tabs tabs-transparent">
        <li class="tab"><a href="#test1">Test 1</a></li>
        <li class="tab"><a class="active" href="#test2">Test 2</a></li>
        <li class="tab disabled"><a href="#test3">Disabled Tab</a></li>
        <li class="tab"><a href="#test4">Test 4</a></li>
      </ul>
    </div>

    </div>
   </div>
   --}}
   </div>
</nav>