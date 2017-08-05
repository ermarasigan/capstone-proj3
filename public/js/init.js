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

    // Initialize select
    $('select').material_select();

    // Hide all doc cards
    $('.docCard').addClass('hide');

    // Show selected doc
    selected = $('#docselect').val();
    $('#doc' + selected).removeClass('hide');

    $('#docselect').change(function(){
      $('.docCard').addClass('hide');
      selected = $('#docselect').val();
      $('#doc' + selected).removeClass('hide');
    });


     $('.materialboxed').materialbox();

    // Token for post method
    token = $('#csrf').val();


    // AJAX Function to create new Blog
    $('.newBlogBtn').click(function(){
      title = $('#newBlogTitle').val();
      content = $('#newBlogContent').val();

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
              // Materialize.toast('New blog added',2000)
              $('#uploadimage').submit();
              // setTimeout(function(){ location.reload(); }, 2000);
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
      var blogID = this.id;

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
      var blogID = this.id;

      editTitle = $('#edit_title' + blogID).val();
      editContent = $('#edit_content' + blogID).val();

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
              $('#uploadimage' + blogID).submit();
              Materialize.toast('Blog updated',2000)
              // setTimeout(function(){ location.reload(); }, 1000);
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
      var blogID = this.id;
      var inputTag = $('#add_tag' + blogID).val();

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
      var blogtagID = this.id;

        $.ajax({
          url: "/removeTag",
          method: "POST",
          data: {
            blogtagID : blogtagID,
            _token    : token
          },
          success: function(data){
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

    // AJAX Function to toggle doc checkbox
    $('.checkbox').click(function(){
      var docreqID = this.id;
      checkboxID = docreqID.split('-');
      docID = checkboxID[1];
      reqID = checkboxID[2];

      if(primary.includes(Number(reqID))){
        if(userdocs.includes(Number(reqID))){
          $('#' + docreqID).prop('checked','true')
        } else {
          $('#' + docreqID).removeAttr('checked')
        }
        Materialize.toast('Action not allowed',1000)
      } else {

        $.ajax({
          url: "/toggleCheckbox",
          method: "POST",
          data: {
            docreqID : docreqID,
            _token    : token
          },
          success: function(data){
            if (typeof data.response != 'undefined'){
              if(data.response == 'success'){
                userdocs = data.attached

                $.each(primary, function( index, value ) {
                  // Change pic depending if user has doc
                  if(userdocs.includes(Number(value))){
                    $('#img' + value).attr('src','/assets/images/doc' + value + 'pic_unlocked.jpg')
                  } else {
                    $('#img' + value).attr('src','/assets/images/doc' + value + 'pic_locked.jpg')
                  }

                  // Toggle checkbox if user has doc
                  $.each(docreqs[value], function( index2, value2){
                    eachID = '#req-' + value + '-' + value2
                    if(userdocs.includes(Number(value2))){
                      $(eachID).prop('checked','true')
                    } else {
                      $(eachID).removeAttr('checked')
                    }
                  })

                  // Format action button for complete reqts
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

              } else {
                if(data.response == 'notlogged'){
                  Materialize.toast('Log in to save progress',1000)
                }
                else {
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
      }
    });

    // AJAX Function to claim document
    $('.docAction').click(function(){
      var docActionID = this.id;
      var docActionID = docActionID.split('-');
      var docClaimID = docActionID[1];
      var action = $('#action-' + docClaimID).html();

      $('#addblog').submit()

      if(action=='Share to FB'){
        $('#addblog').click()
      }

      $.ajax({
        url: "/toggleClaimDoc",
        method: "POST",
        data: {
          docClaimID : docClaimID,
          action    : action,
          _token    : token
        },
        success: function(data){
          if (typeof data.response != 'undefined'){
            if(data.response == 'success'){
              userdocs = data.attached;

              if(data.claimed=='yes'){
                Materialize.toast('Achievement Unlocked!',1000)
              }

              $.each(primary, function( index, value ) {
                // Change pic depending if user has doc
                if(userdocs.includes(Number(value))){
                  $('#img' + value).attr('src','/assets/images/doc' + value + 'pic_unlocked.jpg')
                } else {
                  $('#img' + value).attr('src','/assets/images/doc' + value + 'pic_locked.jpg')
                }

                // Toggle checkbox if user has doc
                $.each(docreqs[value], function( index2, value2){
                  eachID = '#req-' + value + '-' + value2
                  if(userdocs.includes(Number(value2))){
                    $(eachID).prop('checked','true')
                  } else {
                    $(eachID).removeAttr('checked')
                  }
                })

                // Format action button for complete reqts
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

            } else {
              if(data.response == 'notlogged'){
                Materialize.toast('Log in to claim doc',1000)
              }
              else {
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

  }); // end of document ready
})(jQuery); // end of jQuery name space