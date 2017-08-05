
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
  <h6 class="teal-text center-align">Check out these government projects improving the lives of the Filipino people </h6>

  {{-- DIVIDER LINE --}}
  <div class="divider topdivider"></div>

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

  
  {{-- HIDDEN INPUT FOR TOKEN --}}
  <input type="hidden" id="csrf" value={{csrf_token()}}></input>

  {{-- BLOG CARD --}}
  @foreach($blogs as $blog)    
    @include("partials/_blogCard")
    @include("partials/_modalsBlogCard")
  @endforeach

  {{-- PAGINATION LINKS --}}
  <div class="center">{{ $blogs->links() }}</div>

  {{-- DIVIDER LINE --}}
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
    {{-- SECTION HEADING --}}
    <h4 class="center-align amber-text text-darken-1"><b>GUIDES</b></h4>
    <h6 class="amber-text center-align">Sign in to keep track of your docs</h6>

    {{-- DIVIDER LINE --}}
    <div class="divider topdivider"></div>
    <h6><br></h6>

    {{-- DOCUMENT SELECT --}}
    <div class="input-field">
      <select id="docselect">
        @foreach($alldocs as $doc)
          @if(isset($doc->icon))
            <option value="{{ $doc->id }}">{{ $doc->label }}</option>
          @endif
        @endforeach
      </select>
      <label>Choose a document</label>
    </div>

    {{-- DOC CARD --}}
    @foreach($alldocs as $doc)
      @if(isset($doc->icon))
        <div class="card docCard" id="{{ 'doc' . $doc->id}}">
          <div class="card-image">
            <img src=" {{ asset('img/placeholder.png') }}">
          </div>
          <div class="card-content">
            <span class="card-title center">
              <i class="material-icons">{{$doc->icon}}</i>
              {{ " " . $doc->label }}
            </span>
            <label>Requirements</label>
            <form action="#">
              @foreach($doc->reqt as $docreq)
              <p>
                <input id="{{$doc->id . "-" . $docreq->id}}" type="checkbox" class="checkbox"
                  @if(in_array($docreq->id,$userdocs))
                    {{ "checked" }}
                  @endif --}}
                />
                <label for="{{$doc->id . "-" . $docreq->id}}">
                  {{$docreq->agency . " - " . $docreq->label}}
                </label>
              </p>
              @endforeach
            </form>
          </div>
          <div class="card-action">
            <a href="#">This is a link</a>
          </div>
        </div>
      @endif
    @endforeach {{-- /DOC CARD --}}

  </div> {{-- /ASIDE --}}
@endsection