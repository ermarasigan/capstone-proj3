<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

  <title>@yield("title")</title>

  {{-- Materialize JS --}}
  <script src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>
  <script src="{{ asset('js/materialize.js') }}"></script>

  {{-- CSS --}}
  <link href="{{ asset('iconfont/material-icons.css') }}" type="text/css" rel="stylesheet"/>
  <link href="{{ asset('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>

  <!-- icon on browser -->
  <link href="{{ asset('assets/images/favicon.ico')}}" rel="shortcut icon" type="image/x-icon" >   

  {{-- FACEBOOK OPENGRAPH--}}
  <meta property="og:url"           content="http://readytogov.herokuapp.com/" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="Ready to Gov" />
  <meta property="og:description"   content="Keep track of your government doc applications and read blogs about government projects." />
  <meta property="og:image"         content="http://readytogov.herokuapp.com/assets/images/readytogov.jpg" />

</head>

<body class="grey lighten-4">

  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>

  <!-- HEADER  -->
  @include("partials/_header")
  
  <!-- MAIN SECTION  -->
  <main class="container">
    <div class="row">
      <div class="col s12 m6 push-m6 l3 push-l9">
        @yield("aside")
      </div>
      <div class="col s12 m6 pull-m6 l9 pull-l3">
        @yield("content")
      </div>
    </div>
  </main>

  <!-- FOOTER  -->
  @include("partials/_footer")

  <!-- Back to Top Button -->
  <button id="topbtn" class="tooltipped" data-position="left" data-delay="50" data-tooltip="Back to Top" >
    <i class="material-icons">arrow_upward</i>
  </button>


  <!--  Material Initialize Scripts-->
  <script src="{{ asset('js/init.js') }}"></script>

  <!--  AJAX Function Scripts-->
  <script src="{{ asset('js/ajax.js') }}"></script>

  </body>
</html>