{{-- Add Blog Modal --}}

<div id="modal_add" class="modal">
  <div class="modal-content">
    <h4 class="center-align">Create New Blog</h4>
      <div class="row">
        <form class="col s12">
          <div class="row">
            <div class="input-field col s12">
              <input id="newBlogTitle" type="text" data-length="100">
              <label for="newBlogTitle">Blog Title</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <textarea id="newBlogContent" class="materialize-textarea" data-length="3000"></textarea>
              <label for="newBlogContent">Blog Content</label>
            </div>
          </div>
        </form>
      </div>
        <div class="center">
          <a href="#!" class="newBlogBtn modal-action waves-effect waves-green btn">Save</a>
          <a href="#!" class="modal-action modal-close waves-effect waves-green btn grey">Close</a>
        </div>
      </div>
    <div class="modal-footer center">
  </div>
</div>