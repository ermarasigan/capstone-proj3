{{-- Add Blog Modal --}}

<div id="modal_add" class="modal">
  <div class="modal-content">
    <h4 class="center-align">Create New Blog</h4>
      <div class="row">
        <div class="input-field col s12">
          <input id="newBlogTitle" type="text" data-length="100" required>
          <label for="newBlogTitle">Blog Title</label>
        </div>
        <div class="input-field col s12">
          <textarea id="newBlogContent" class="materialize-textarea" data-length="3000" required></textarea>
          <label for="newBlogContent">Blog Content</label>
        </div>
        {{-- Image Upload --}}
        <form id="uploadimage" action="/fileUpload" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="file-field input-field col s12">
            <div class="btn">
              <span>File</span>
              <input type="file" name="image" required>
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" placeholder="Upload image (max size 2MB)">
            </div>
          </div>
        </form>
      </div>
      {{-- Modal Actions --}}
      <div class="center">
        <a href="#!" class="newBlogBtn modal-action waves-effect waves-green btn">Save</a>
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn grey">Close</a>
      </div>
      </div>
    </div>
  <div class="modal-footer center">
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif
  </div>
</div>