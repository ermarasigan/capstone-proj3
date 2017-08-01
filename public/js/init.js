(function($){
  $(function(){

    // Initialize Carousel
    $('.carousel').carousel();

    // Call next carousel slide
  	setInterval(function() {
    	$('.carousel').carousel('next');
  	}, 3500);

  	// Initialize pushpin
  	$('#aside').pushpin({ top:110, bottom:500 });

  	// Initialize all modals
  	$('.modal').modal();

    // Autoresize textarea
    $('.materialize-textarea').trigger('autoresize');

    // Token for post method
    token = $('#csrf').val();

    // AJAX Function to create new Blog
    $('.newBlogBtn').click(function(){
      title = $('#newBlogTitle').val();
      content = $('#newBlogContent').val();

      // Ajax function to add tag, post method
        $.ajax({
          url: "/newBlog",
          method: "POST",
          data: {
            title     : title,
            content   : content,
            _token    : token
          },
          success: function(data){
            console.log(data);
            if (typeof data.response != 'undefined'){
              if(data.response == 'success'){
                $('#newBlogContent').val('')
                $('#newBlogTitle').val('')
                Materialize.toast('New blog added',1000)
                setTimeout(function(){ location.reload(); }, 1000);
              } else {
                console.log(data.response)          
              }
            } else {
              console.log('no return')
            }
          },
          error: function(response,data){
            console.log(response)
            console.log(data)
          }
        })
    });

    // AJAX Function to delete blog
    $('.deleteBlogBtn').click(function(){
      // Save tag name from input
      var blogID = this.id;

      // Ajax function to add tag, post method
        $.ajax({
          url: "/deleteBlog",
          method: "POST",
          data: {
            blogID : blogID,
            _token    : token
          },
          success: function(data){
            console.log(data);
            if (typeof data.response != 'undefined'){
              if(data.response == 'success'){
                
                Materialize.toast('Blog deleted',1000)
                setTimeout(function(){ location.reload(); }, 1000);
              } else {
                console.log(data.response)          
              }
            } else {
              console.log('no return')
            }
          },
          error: function(response,data){
            console.log(response)
            console.log(data)
          }
        })
    });

    // AJAX Function to update blog
    $('.editBlogBtn').click(function(){
      // Save tag name from input
      var blogID = this.id;

      editTitle = $('#edit_title' + blogID).val();
      editContent = $('#edit_content' + blogID).val();

      // Ajax function to add tag, post method
        $.ajax({
          url: "/editBlog",
          method: "POST",
          data: {
            blogID      : blogID,
            editTitle   : editTitle,
            editContent : editContent,
            _token      : token
          },
          success: function(data){
            console.log(data);
            if (typeof data.response != 'undefined'){
              if(data.response == 'success'){
                
                Materialize.toast('Blog updated',1000)
                setTimeout(function(){ location.reload(); }, 1000);
              } else {
                console.log(data.response)          
              }
            } else {
              console.log('no return')
            }
          },
          error: function(response,data){
            console.log(response)
            console.log(data)
          }
        })
    });

    // AJAX Function to add tag
    $('.addTagBtn').click(function(){
      // Save tag name from input
      var blogID = this.id;
      var inputTag = $('#add_tag' + blogID).val();

      // Ajax function to add tag, post method
      $.ajax({
        url: "/addTag",
        method: "POST",
        data: {
          blogID    : blogID,
          inputTag  : inputTag,
          _token    : token
        },
        success: function(data){
          if (typeof data.response != 'undefined'){
            if(data.response == 'success'){
              Materialize.toast('Tag added',1000)
              setTimeout(function(){ location.reload(); }, 1000);
            } else {
              if(data.response == 'tag exists'){
                Materialize.toast('Tag already exists',1000)
              } else {
                console.log(data.response)  
              }
            }
          } else {
            console.log('no return')
          }
        },
        error: function(response,data){
          console.log(response)
          console.log(data)
        }
      })
    });

    // AJAX Function to remove tag
    $('.removeTagBtn').click(function(){
      // Save tag name from input
      var blogtagID = this.id;

      // Ajax function to add tag, post method
        $.ajax({
          url: "removeTag",
          method: "POST",
          data: {
            blogtagID : blogtagID,
            _token    : token
          },
          success: function(data){
            console.log(data);
            if (typeof data.response != 'undefined'){
              if(data.response == 'success'){
                 Materialize.toast('Tag removed',1000)
                  setTimeout(function(){ location.reload(); }, 1000);
              } else {
                console.log(data.response)          
              }
            } else {
              console.log('no return')
            }
          },
          error: function(response,data){
            console.log(response)
            console.log(data)
          }
        })
    });

    
  }); // end of document ready
})(jQuery); // end of jQuery name space