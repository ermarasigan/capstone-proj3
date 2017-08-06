{{-- DOC CARD PARTIAL --}}
@foreach($alldocs as $doc)
  @if(isset($doc->icon))
    <div class="card docCard" id="{{ 'doc' . $doc->id}}">

      {{-- DOC IMAGE IS LOCKED OR UNLOCKED --}}
      <div class="card-image">
        @if(in_array($doc->id,$userdocs))
          <?php $lock = 'unlocked' ?>
        @else
          <?php $lock = 'locked' ?>
        @endif
        <img id="{{'img' . $doc->id}}" src=" {{ asset('assets/images/doc' . $doc->id . 'pic_' . $lock . '.jpg') }}">
      </div>

      {{-- CARD CONTENT --}}
      <div class="card-content">
        <span class="card-title center">
          <i class="material-icons">{{$doc->icon}}</i>
          {{ " " . $doc->label . " (" . $doc->agency . ")" }}
        </span>

        <label>Requirements</label>
        {{-- CHECKBOX FOR DOC REQUIREMENTS --}}
        <form action="#">
          @foreach($doc->reqt as $docreq)
          <p>
            <input id="{{ 'req-' . $doc->id . '-' . $docreq->id}}" type="checkbox" class="checkbox"
              @if(in_array($docreq->id,$userdocs))
                {{ "checked" }}
              @endif
            />
            <label for="{{ 'req-' . $doc->id . '-' . $docreq->id}}">
              {{$docreq->agency . " - " . $docreq->label}}
            </label>
          </p>
          @endforeach
        </form>
      </div>

      {{-- CARD ACTION (CLAIM) --}}
      @if(Auth::user())
        <div class="card-action center determinate">
          <button id="{{ 'action-' . $doc->id}}" class="btn grey docAction">Incomplete</button>
        </div>
      @endif
    </div> {{-- DOC CARD --}}

    {{-- MODAL FOR ACHIEVEMENT UNLOCKED --}}
    <div id="{{ "modal_unlock" . $doc->id }}" class="modal center" style="z-index:1">
      <div class="modal-content">
        <h4 class="amber-text">
          COMPLETED: 
          {{ $doc->label }}
        </h4>
        <img class="responsive-img" src=" {{ asset('assets/images/doc' . $doc->id . 'pic_unlocked.jpg') }}">
        {{-- <a id="{{ $blog->id }}" href="#!" class="shareBtn modal-action modal-close waves-effect waves-blue blue btn">Share</a> --}}

        {{-- Facebook Share --}}
        <div class="fb-share-button" data-href="http://readytogov.herokuapp.com" data-layout="button" data-size="large" data-mobile-iframe="false">
          <a class="fb-xfbml-parse-ignore  btn blue" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Freadytogov.herokuapp.com%2F&amp;src=sdkpreparse">Share</a>
          <a href="#!" class="modal-action modal-close waves-effect waves-grey grey btn">Close</a>
        </div>
      </div> 
    </div>
  @endif {{-- IF DOC HAS ICON --}}

@endforeach {{-- LOOP FOR ALL DOCS --}}


{{-- SCRIPT FOR INITIAL VIEW OF DOCS --}}
<script type="text/javascript">
  (function($){
    $(function(){
      
      // SAVE VALUES FROM VIEW FOR JQUERY USE
      primary={!! json_encode($primary) !!}
      docreqs={!! json_encode($docreqs) !!}
      userdocs={!! json_encode($userdocs) !!}

      $.each(primary, function( index, value ) {
        // Initial format for doc action
        actionID = '#action-' + value;
        var reqComplete = true;

        $.each(docreqs[value], function( index2, value2){
          if(!userdocs.includes(Number(value2))){
            reqComplete = false;
          }
        })

        // Action button for Document
        if(reqComplete){
          $(actionID).removeClass('grey')
          $(actionID).removeClass('blue')
          $(actionID).removeClass('teal')
          if(userdocs.includes(value)){
            // $(actionID).html('Complete')
            $(actionID).addClass('blue')
            $(actionID).html('Share to FB')
          } else {
            $(actionID).addClass('teal')
            $(actionID).html('Claim document')
          }
        } else {
          $(actionID).addClass('grey')
          $(actionID).html('Incomplete')
        }
      });
      
    }); // end of document ready
  })(jQuery); // end of jQuery name space
</script>