
@extends("../layouts/master")

{{-- TITLE SECTION --}}
@section("title")
	{{ $title }}
@endsection

{{-- CONTENT SECTION --}}
@section("content") 

  {{-- CONTENT HEADER --}}
  <h4 class="center-align cyan-text text-darken-3">
    <b>
    BLOGS
    @if($title=='Tagged Blogs (Ready to Gov)')
      tagged as 
    @endif
    </b>
    @if(Auth::user() && Auth::user()->role == 'admin')
      <a class="btn btn-floating blue waves-effect waves-light modal-trigger tooltipped" 
        data-position="right" data-delay="50" data-tooltip="Add Blog" href="#modal_add">
        <i class="material-icons">add</i>
      </a>
    @endif
  </h4>

  {{-- TAG CHIPS --}}
  TAGS 
  @foreach($tags as $tag)
    <a href="/tag/{{$tag->id}}">
      <div class="chip">
        {{$tag->name}}
      </div>
    </a>
  @endforeach

  @if($title=='Tagged Blogs (Ready to Gov)')
    <a href="/">
      <div class="chip teal lighten-2">
        {{ "ALL" }} 
      </div>
    </a>
  @endif

  {{-- DIVIDER LINE --}}
  <div class="divider topdivider"></div>
  
  {{-- HIDDEN INPUT FOR TOKEN --}}
  <input type="hidden" id="csrf" value={{csrf_token()}}></input>

  {{-- BLOG CARD --}}
  @foreach($blogs as $blog)    
    @include("partials/_blogCard")
    @include("partials/_modalsBlogCard")
  @endforeach

  {{-- PAGINATION LINKS --}}
  <div class="center">{{ $blogs->links() }}</div>

  <div class="divider topdivider"></div>

  <h4 class="center-align cyan-text text-darken-3">
    <b>INSPIRATION</b>  
  </h4>

  {{-- QUOTEFANCY CAROUSEL --}}  
  @include("partials/_carousel")

  {{-- Add Blog Modal --}}
  @include("partials/_modalAddBlog")

@endsection {{-- /CONTENT SECTION --}}

{{-- ASIDE SECTION --}}
@section("aside")
  <div id="aside">
    <h4 class="center-align amber-text text-darken-1"><b>GUIDES</b></h4>
    <div class="divider topdivider"></div>
    <div class="card">
      <div class="card-image">
        <img src=" {{ asset('img/placeholder.png') }}">
        <span class="card-title">Card Title</span>
      </div>
      <div class="card-content">
        <form action="#">
          <p>
            <input type="checkbox" id="test5" {{ "checked" }}/>
            <label for="test5">Reqt 1</label>
          </p>
          <p>
            <input type="checkbox" id="test6" />
            <label for="test6">Reqt 2</label>
          </p>
        </form>
      </div>
      <div class="card-action">
        <a href="#">This is a link</a>
      </div>
    </div>
  </div>
@endsection