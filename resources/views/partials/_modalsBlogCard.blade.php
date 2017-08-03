{{-- BLOG MODALS PARTIAL --}}

{{-- Modal for Deleting Blog --}}
<div id="{{ "modal_del" . $blog->id }}" class="modal center">
  <div class="modal-content">
    <h4>
      Delete Blog?
    </h4>
    <p>This action is not reversible.</p>
    <a id="{{ $blog->id }}" href="#!" class="deleteBlogBtn modal-action waves-effect waves-red red btn">Yes</a>
    <a href="#!" class="modal-action modal-close waves-effect waves-grey grey btn">No</a>
  </div> 
</div>

{{-- Modal for Editing Blog --}}
<div id="{{ "modal_edit" . $blog->id }}" class="modal center">
  <div class="modal-content">
    <h4>Edit Blog</h4>
      <div class="row">
        <div class="input-field col s12">
          <input id="{{ "edit_title" . $blog->id }}" type="text" data-length="100" value="{{ $blog->title }}">
          <label for="input_text">Blog Title</label>
        </div>
      
        <div class="input-field col s12">
          <textarea id="{{ "edit_content" . $blog->id }}" class="materialize-textarea" data-length="3000">{{ $blog->content }}</textarea>
          <label for="textarea1">Blog Content</label>
        </div>

        <form id="{{ "uploadimage" . $blog->id }}" action="/fileUpload" method="post" enctype="multipart/form-data">
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
    <div class="center">
      <a id="{{ $blog->id }}" href="#!" class="editBlogBtn modal-action waves-effect waves-green btn center-align">Save</a>
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn center-align grey">Close</a>
    </div>
  </div>
</div>

{{-- Modal for Adding Tag to Blog --}}
<div id="{{ "modal_tag" . $blog->id }}" class="modal center-align">
  <div class="modal-content">
    <h4>Add Tag</h4>
      <div class="row">
        <form class="col s12">
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">textsms</i>
              <input id="{{ "add_tag" . $blog->id }}" class="autocomplete" type="text" data-length="100">
              <label for="input_text">Tag Name</label>
            </div>
          </div>
        </form>
      </div>
    <div class="center">
      <a id="{{ $blog->id }}" href="#!" class="addTagBtn modal-action waves-effect waves-green btn center-align">Save</a>
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn center-align grey">Close</a>
    </div>
  </div>
</div>