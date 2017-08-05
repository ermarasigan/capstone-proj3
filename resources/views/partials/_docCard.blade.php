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
    </div>
  @endif
@endforeach {{-- /DOC CARD --}}

<script type="text/javascript">
  (function($){
    $(function(){
      
      // SAVE VALUES TO FROM VIEW FOR JQUERY USE
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