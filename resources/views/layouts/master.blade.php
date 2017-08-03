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

  {{-- FACEBOOK OPENGRAPH--}}
  <meta property="og:url"           content="http://readytogov.herokuapp.com/" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="Your Website Title" />
  <meta property="og:description"   content="Your description" />
  <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" />

</head>

<body class="grey lighten-4">

  <!-- Load Facebook SDK for JavaScript -->
{{--   <div id="fb-root"></div>
  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script> --}}

  <!-- HEADER  -->
  @include("partials/_header")
{{-- 
  <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
 --}}
   {{-- <div class="fb-share-button" data-href="http://localhost:8000/" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="http://localhost:8000/">Share</a></div> --}}


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

  <!--  Scripts-->
  <script src="{{ asset('js/init.js') }}"></script>

  </body>
</html>