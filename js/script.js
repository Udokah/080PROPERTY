
	// SET AJAX PARAMETERS
	$.ajaxSetup({
   global: false,
   cache: false,
   type: "POST"
   });

//// Jquery UI Alert
window.old_alert = window.alert;
window.alert = function(message, fallback){
    if(fallback)
    {
        old_alert(message);
        return;
    }
    $(document.createElement('div'))
        .attr({title: 'Alert', 'class': 'alert'})
        .html(message)
        .dialog({
            buttons: {OK: function(){$(this).dialog('close');}},
            close: function(){$(this).remove();},
            draggable: true,
            modal: true,
            resizable: false,
            width: 'auto'
        });
};


//// FOR STICKY HEADER
$(document).ready(function() {
	
    var s = $(".header");
	var profile = $("#myprofile");
    var pos = s.position();                    
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();
        if (windowpos >= pos.top) {
            s.addClass("stick");
			profile.addClass("stick2");
			 $(".propOptions").addClass("stick2");
        }
		if(windowpos == 0){
            s.removeClass("stick");
			profile.removeClass("stick2");
			$(".propOptions").removeClass("stick2");
        }
		
		
    });
});


// MAIN SYSTEM NAV TOOLS manage users,add property, manage property
$(document).ready(function() {
	
	var tool = ".tools li a" ;
	
		$(tool).on('mouseenter', function(){
	$(this).next("span").fadeIn('fast', function(){
		$(this).css('display','inline-block');
		$(this).animate({ marginTop: '1px' }, 600);
		
		playSound() ; // play sound ;
		
		});
		}).on('mouseleave', function(){
	$(this).next("span").slideUp('fast', function(){
		$(this).animate({ marginTop: '-80px' }, 300);
		});
		});
		
	});
	
	// Activate Scroll bar style plugin
	 $(document).ready(
  function(){ 
   $("html").niceScroll({styler:"fb",cursorcolor:"#DD0923"});
  });

 $(function() {
    $( document ).tooltip({
      position: {
        my: "center bottom-20",
        at: "center top",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
            .addClass( "arrow" )
            .addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
      }
    });
  });
  
  //Validate interger value input
function isInt(n){
	var reInt = new RegExp(/^-?\d+$/);
	if (!reInt.test(n)) {
		return false;
	}
	return true;
}