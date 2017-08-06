// Materialize Elements Initialize JS

(function($){
  $(function(){

    // Initialize Carousel
    $('.carousel').carousel();

    // Call next carousel slide
  	setInterval(function() {
    	$('.carousel').carousel('next');
  	}, 3500);

  	// Initialize pushpin
  	// $('#aside').pushpin({ top:110, bottom:500 });

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

    // Show card based on selected item
    $('#docselect').change(function(){
      $('.docCard').addClass('hide');
      selected = $('#docselect').val();
      $('#doc' + selected).removeClass('hide');
    });

    // Initialize material box
    $('.materialboxed').materialbox();

    // When the user scrolls down 20px from the top of the document, show the back to top button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("topbtn").style.display = "block";
        } else {
            document.getElementById("topbtn").style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    $(function() {
        $('#topbtn').click(function(){ 
            $('html, body').animate({scrollTop:0}, 1500, 'easeInOutExpo'
        )});
    })

  }); // end of document ready
})(jQuery); // end of jQuery name space