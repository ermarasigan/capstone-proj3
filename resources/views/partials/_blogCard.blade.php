{{-- BLOG CARD PARTIAL--}}

{{-- Format blog content into paragraphs --}}
<?php
  $content_data = explode("\n", $blog->content);
  $content_first = $content_data[0];
  $content = "<p>" . implode("</p><p>", array_values($content_data));
?> 

{{-- BLOG CARD   --}}
<div class="card sticky-action">

  {{-- CARD IMAGE --}}
  <div class="card-image waves-effect waves-block waves-light tooltipped" 
    data-position="bottom" data-delay="50" data-tooltip="Read more">
    <img class="activator" src="{{ asset($blog->image_url) }}">
  </div>

  {{-- CARD CONTENT --}}
  <div class="card-content">
    {{-- BLOG TITLE --}}
    <span class="card-title activator grey-text text-darken-4">
      {!! $blog->title !!}
    </span>
    <i>Posted {{ $blog->created_at->diffForHumans() }}</i>
    {{-- BLOG TAGS --}}
    @foreach($blog->tag as $blogtag)
      <div class="chip">
        <a href="/tag/{{$blogtag->id}}">
          {{$blogtag->name}}
        </a>
        <i id="{{$blog->id . "-" . $blogtag->id}}" 
          class="close material-icons removeTagBtn
          @if($title=='Tagged Blogs (Ready to Gov)' || Auth::user()->role != 'admin')
            {{ "hide" }}
          @endif
          ">
          close
        </i>
      </div>
    @endforeach
    {{-- BLOG 1ST PARAGRAPH --}}
    <p>
      <br> {{ $content_first }} <br>
    </p>
    <div class="right-align">
      <button class="btn activator">Read more</button>
    </div>
  </div>

  {{-- CARD REVEAL --}}
  <div class="card-reveal">
    <span class="card-title grey-text text-darken-4">
      {{$blog->title}}
      <i class="material-icons right">
        close
      </i>
    </span>
    {!! $content !!}
    <br>
    <span class="card-title activator center btn white-text">
      close
    </span>
  </div>

  {{-- CARD ACTION --}}
  @if(Auth::user() && Auth::user()->role == 'admin')
    <div class="card-action right-align grey lighten-2">
      <div class="left-align">
        <a class="waves-effect waves-light btn red lighten-2 modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete Blog" href="{{ "#modal_del" . $blog->id }}">
          <i class="material-icons">delete</i>
        </a>
        <a class="waves-effect waves-light btn orange lighten-2 modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Add Tag" href="{{ "#modal_tag" . $blog->id }}">
          <i class="material-icons">note_add</i>
        </a>
        <a class="waves-effect waves-light btn blue lighten-2 modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit Blog" href="{{ "#modal_edit" . $blog->id }}">
          <i class="material-icons">border_color</i>
        </a>
      </div>
    </div>
  @endif
</div> {{-- /BLOG CARD --}}

<h5><br></h5>

{{-- For autocomplete of tags --}}
<script type="text/javascript">

  (function($){
    $(function(){

      $('input.autocomplete').autocomplete({
        data: {
          @foreach($alltags as $onetag)
            "{{ $onetag->name }}": null,
          @endforeach
        },
        limit: 10, // The max amount of results that can be shown at once. Default: Infinity.
        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
      });

    }); // end of document ready
  })(jQuery); // end of jQuery name space

</script>