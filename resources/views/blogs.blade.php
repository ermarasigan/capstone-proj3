{{-- PRIMARY VIEW --}}

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
      <a id="addblog" class="btn btn-floating blue waves-effect waves-light modal-trigger tooltipped" 
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

  {{-- CHIP TO GO TO HOME PAGE --}}
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

  <h6 class="teal-text center-align">Difficulty is opportunity. Don't give up just yet. </h6>

  {{-- QUOTEFANCY CAROUSEL --}}  
  @include("partials/_carousel")

  {{-- Add Blog Modal --}}
  @include("partials/_modalAddBlog")

@endsection {{-- /CONTENT SECTION --}}

{{-- ASIDE SECTION --}}
@section("aside")
      
  <div id="aside">
    {{-- SECTION HEADING --}}
    <h4 class="center-align amber-text text-darken-2"><b>GUIDES</b></h4>
    <h6 class="amber-text text-darken-2 center-align">
      @if(Auth::user())
        {{ 'Welcome back, ' . Auth::user()->name . '!' }}
      @else
        {{ 'Sign in to keep track of your docs' }}
      @endif
    </h6>

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
    @include("partials/_docCard")


    {{-- CAREERS SECTION --}}
    <h4 class="center-align amber-text text-darken-2"><b>CAREERS</b></h4>
    <h6 class="amber-text text-darken-2 center-align">Consider serving in the country's largest employer - the government.</h6>

    <div class="divider topdivider"></div>
    <h6><br></h6>

    {{-- Career Accordion --}}
    <ul class="collapsible" data-collapsible="accordion">
    <li>
      <div class="collapsible-header active">
        <i class="material-icons">flag</i>Gov.ph
      </div>
      <div class="collapsible-body">
        <a href="https://www.gov.ph/job-vacancies" target="_blank">
          <img class="responsive-img" src=" {{ asset('assets/images/govph.jpg') }}">
        </a>
      </div>
    </li>
    <li>
      <div class="collapsible-header">
        <i class="material-icons">nature_people</i>Jobstreet
      </div>
      <div class="collapsible-body">
        <a href="https://www.jobstreet.com.ph/government" target="_blank">
          <img class="responsive-img" src=" {{ asset('assets/images/jobstreet.jpg') }}">
        </a>
      </div>
    </li>
    <li>
      <div class="collapsible-header">
        <i class="material-icons">business</i>Kalibrr
      </div>
      <div class="collapsible-body">
        <a href="https://www.kalibrr.com/discover/industry/govph" target="_blank">
          <img class="responsive-img" src=" {{ asset('assets/images/kalibrr.jpg') }}">
        </a>
      </div>
    </li>
  </ul>

  </div> {{-- /ASIDE --}}
@endsection