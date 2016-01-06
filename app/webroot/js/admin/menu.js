/* 
   Simple JQuery Accordion menu.
   HTML structure to use:

   <ul id="menu">
     <li><a href="#">Sub menu heading</a>
     <ul>
       <li><a href="http://site.com/">Link</a></li>
       <li><a href="http://site.com/">Link</a></li>
       <li><a href="http://site.com/">Link</a></li>
       ...
       ...
     </ul>
     <li><a href="#">Sub menu heading</a>
     <ul>
       <li><a href="http://site.com/">Link</a></li>
       <li><a href="http://site.com/">Link</a></li>
       <li><a href="http://site.com/">Link</a></li>
       ...
       ...
     </ul>
     ...
     ...
   </ul>

Copyright 2007 by Marco van Hylckama Vlieg

web: http://www.i-marco.nl/weblog/
email: marco@i-marco.nl

Free for non-commercial use
*/
if(window.location.hostname == 'braintech'){  
		BASE = "http://braintech/CURRENT/mytraining/Code/admin/";
	}else if((window.location.hostname == '1771.digital') || (window.location.hostname == 'capgraph.mu') ){
	    BASE = "http://"+window.location.hostname+"/testing/mytraining/admin/";	
	}else if((window.location.hostname == 'mytraining.mu') || (window.location.hostname == 'www.mytraining.mu')){
	    BASE = "http://"+window.location.hostname+"/admin/";	
	}else{
		BASE = "http://"+window.location.hostname+"/mytraining/admin/";
	}

function initMenu() {
  $('#menu ul').hide();
  $('#menu ul').children('.active').parent().show();
  //$('#menu ul:first').show();
  $('#menu li a').click(
    function() {
      var checkElement = $(this).next();
      if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
        return false;
        }
      if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
        $('#menu ul:visible').slideUp('normal');
        checkElement.slideDown('normal');
        return false;
        }
      }
    );
  }
$(document).ready(function() {
	initMenu();
	
	/******************************  PlaceList  **************************************/
	$('.townlistcls').on('change',function(){
		var e = $(this).val();
		var alias = $(this).attr('id');
		//alert(e);
		$.ajax({
			method:'POST',
			url: BASE+'towns/placelist',
			data:{town_id:e,alias:alias},			
		}).done(function(res){
			$('#place').html(res);
		});
	});
	/**************************************** END ***********************************/
	
	
	});