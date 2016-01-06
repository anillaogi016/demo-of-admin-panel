$(document).ready( function() {
	if(window.location.hostname == 'braintech'){  
		BASE_URL = "http://braintech/CURRENT/mytraining/Code/";
	}else if((window.location.hostname == '1771.digital') || (window.location.hostname == 'capgraph.mu') ){
	    BASE_URL = "http://"+window.location.hostname+"/testing/mytraining/";	
	}else if((window.location.hostname == 'mytraining.mu') || (window.location.hostname == 'www.mytraining.mu')){
	    BASE_URL = "http://"+window.location.hostname+"/";	
	}else{
		BASE_URL = "http://"+window.location.hostname+"/mytraining/";
	}	
	var emailpattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	
	/***********LOGIN POPUP******************/
	$('#login').on('click',function(){		
		$('#popup_box').fadeIn(1000);
	    
	});	
	$("#popupBoxClose").click(function(){
        $('input').removeClass('error_field');		
	    $('.error').html('');
		$('#popup_box').hide();
	});
	/*****************END********************/
	
	/*********** Customer Register POPUP******************/
	$('#register').on('click',function(){	
        
		$('#popupnew_contct').fadeIn(1000);
	    
	});
	$('#custmr_regstr').on('click',function(){
		$('#popupnew_contct').hide();
        //$('#popup_box').hide();			
		$('#registerpopup_box').fadeIn(1000);
	    
	});
	$('#registerpopupBoxClose').click(function(){
        $('input').removeClass('error_field');		
	    $('.error').html('');
	    $('#RegisterPopupForm')[0].reset();
	    $('#registerpopup_box').hide();
	});
	$('#afterregisterpopupBoxClose').click(function(){
            var cnfrmrelt = window.confirm('Are you sure you wish to cancel the registration?');
			if(cnfrmrelt == true){
				$('input').removeClass('error_field');
				$('.error').html('');
				$('#afterregisterpopup_box').hide();
			}	         
			 });
	$("#popupnew_contctBoxClose").click(function(){ 
	    $('input').removeClass('error_field');
		$('.error').html('');
	    $('#popupnew_contct').hide();
	});
	/*****************END********************/
	
	/*********** Trainer Register POPUP******************/
	$('#trainr_regstr').on('click',function(){
        
		$('#popupnew_contct').hide();		
       // $('#popup_box').hide();	
		$('#contactuspopup_box').fadeIn(1000);	    
	});	
	$("#contactuspopupBoxClose").click(function(){ 
	    $('#contactuspopup_box').hide();
		$('input').removeClass('error_field');
		$('.error').html('');
	});
	/*****************END********************/
	
	
	
	/***********contact SUBMIT ( Trainer )******************/
	var contactflag = false;
	$('#TrainerContactViewForm').on('submit',function(event){
	//alert('jj')
		$('#TrainerContactEmail').removeClass('error_field');
		$('#TrainerContactMessage').removeClass('error_field');
		$('#contact_error').hide();
		if(contactflag === true){
			contactflag = false; 
            return;
		}
		event.preventDefault();
		var ch=0;
		var email = $.trim($('#TrainerContactEmail').val());
		var msg = $.trim($('#TrainerContactMessage').val());
		
		if(email==""){
		    $('#contact_error').html('Please enter an email.');
			$('#contact_error').show();
		    $('#TrainerContactEmail').addClass('error_field');
		    ch++;
	    }
		if(msg==""){
			$('#contact_error').html('Please enter message.');
			$('#contact_error').show();
			$('#TrainerContactMessage').addClass('error_field');
		    ch++;
	    }
		
		if(email=="" && msg==""){
			$('#contact_error').html('Email & message is required');
			$('#contact_error').show();
			$('#UpgradeContactEmail','#TrainerContactMessage').addClass('error_field');			
		}
		if(email!=""){
			var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!pattern.test(email))
			{
			    $('#contact_error').html('Please enter valid email.');
				$('#contact_error').show();
			    $('#TrainerContactEmail').addClass('error_field');
			    ch++;
			}
	    }
        if(ch==0){
		
			contactflag = true;
			$('#TrainerContactViewForm').submit();			
	    }	
	});
	/*****************END********************/
	
	/***********upgrade SUBMIT ( Trainer )******************/
	var contactflag = false;
	$('#UpgradeContactCoursesForm').on('submit',function(event){
	//alert('jj')
		$('#UpgradeContactEmail').removeClass('error_field');
		$('#UpgradeContactMessage').removeClass('error_field');
		$('#contact_error').hide();
		if(contactflag === true){
			contactflag = false; 
            return;
		}
		event.preventDefault();
		var ch=0;
		var email = $.trim($('#UpgradeContactEmail').val());
		var msg = $.trim($('#UpgradeContactMessage').val());
		var packid = $.trim($('#UpgradeContactPackId').val());
		
		if(email==""){
		    $('#contact_error').html('Please enter an email.');
			$('#contact_error').show();
		    $('#UpgradeContactEmail').addClass('error_field');
		    ch++;
	    }
		if(msg==""){
			$('#contact_error').html('Please enter message.');
			$('#contact_error').show();
			$('#UpgradeContactMessage').addClass('error_field');
		    ch++;
	    }
		if(packid==""){
			$('#contact_error').html('Please select pack.');
			$('#contact_error').show();
			$('#UpgradeContactPackId').addClass('error_field');
		    ch++;
	    }
		if(packid=="" && msg==""){
			$('#contact_error').html('Pack & message is required');
			$('#contact_error').show();
			$('#UpgradeContactPackId','#UpgradeContactMessage').addClass('error_field');			
		}
		if(email!=""){
			var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!pattern.test(email))
			{
			    $('#contact_error').html('Please enter valid email.');
				$('#contact_error').show();
			    $('#UpgradeContactEmail').addClass('error_field');
			    ch++;
			}
	    }
        if(ch==0){
		
			contactflag = true;
			$('#UpgradeContactCoursesForm').submit();			
	    }	
	});
	/*****************END********************/
	
	/***********request booking SUBMIT ( Trainer )******************/
	var contactflag = false;
	$('#RequestBookingViewForm').on('submit',function(event){
	//alert('jj')
		$('#RequestBookingEmail').removeClass('error_field');
		$('#RequestBookingMessage').removeClass('error_field');
		$('#booking_request_error').hide();
		if(contactflag === true){
			contactflag = false; 
            return;
		}
		event.preventDefault();
		var ch=0;
		var email = $.trim($('#RequestBookingEmail').val());
		var msg = $.trim($('#RequestBookingMessage').val());
		
		if(email==""){
		    $('#booking_request_error').html('Please enter an email.');
			$('#booking_request_error').show();
		    $('#RequestBookingEmail').addClass('error_field');
		    ch++;
	    }
		if(msg==""){
			$('#booking_request_error').html('Please enter message.');
			$('#booking_request_error').show();
			$('#RequestBookingMessage').addClass('error_field');
		    ch++;
	    }
		
		if(email=="" && msg==""){
			$('#booking_request_error').html('Email & message is required');
			$('#booking_request_error').show();
			$('#RequestBookingEmail','#RequestBookingMessage').addClass('error_field');			
		}
		if(email!=""){
			var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!pattern.test(email))
			{
			    $('#booking_request_error').html('Please enter valid email.');
				$('#booking_request_error').show();
			    $('#RequestBookingEmail').addClass('error_field');
			    ch++;
			}
	    }
        if(ch==0){
		
			contactflag = true;
			$('#RequestBookingViewForm').submit();			
	    }	
	});
	/*****************END********************/
	
	/***********LOGIN SUBMIT ( Trainer )******************/
	var trainerflag = false;
	$('#TrainerIndexForm').on('submit',function(event){
		$('#TrainerEmail').removeClass('error_field');
		$('#TrainerPassword').removeClass('error_field');
		$('#login_error').hide();
		if(trainerflag === true){
			trainerflag = false; 
            return;
		}
		event.preventDefault();
		var ch=0;
		var email = $.trim($('#TrainerEmail').val());
		var password = $.trim($('#TrainerPassword').val());		
		if(email==""){
		    $('#login_error').html('Please enter an email.');
			$('#login_error').show();
		    $('#TrainerEmail').addClass('error_field');
		    ch++;
	    }
		if(password==""){
			$('#login_error').html('Please enter a password.');
			$('#login_error').show();
			$('#TrainerPassword').addClass('error_field');
		    ch++;
	    }
		if(email=="" && password==""){
			$('#login_error').html('Email & Password is required');
			$('#login_error').show();
			$('#TrainerEmail','#TrainerPassword').addClass('error_field');			
		}
		
        if(ch==0){
		    $.ajax({		    
			    url:BASE_URL+'users/login_validate',
				method: "POST",
			    data:{Trainer:{email:email,password:password}},			    
			}).done(function(msg){
				
				var data = jQuery.parseJSON(msg);
				var status = data.status;
				var message = data.message;
				if(status == 'error'){
					
					if(typeof message.email !== 'undefined') {
						$('#login_error').html(message.email);
						 $('#TrainerEmail').addClass('error_field');
					}else if(typeof message.password !== 'undefined'){
						$('#login_error').html(message.password);
						$('#TrainerPassword').addClass('error_field');
					}else{
						$('#login_error').html(message.invalid);
						$('#TrainerEmail','#TrainerPassword').addClass('error_field');
					}
                    $('#login_error').show();				
				}else if(status == 'success'){
				    trainerflag = true;
                    $('#TrainerIndexForm').submit();					
				}			    
		    });			
	    }	
	});
	/*****************END********************/
	
	/***********LOGIN SUBMIT ( Customer )******************/
	var customerflag = false;
	$('#CustomerLoginForm').on('submit',function(event){		
		$('#CustomerLoginEmail').removeClass('error_field');
		$('#UserPassword').removeClass('error_field');
		$('#user_login_error').hide();
		if(customerflag === true){
			customerflag = false; 
            return;
		}
		event.preventDefault();
		var ch=0;
		var email = $.trim($('#CustomerLoginEmail').val());
		var password = $.trim($('#UserPassword').val());		
		if(email==""){
		    $('#user_login_error').html('Please enter an email.');
			$('#user_login_error').show();
		    $('#CustomerLoginEmail').addClass('error_field');
		    ch++;
	    }
		if(password==""){
			$('#user_login_error').html('Please enter a password.');
			$('#user_login_error').show();
			$('#UserPassword').addClass('error_field');
		    ch++;
	    }
		if(email=="" && password==""){
			$('#user_login_error').html('Email & Password is required');
			$('#user_login_error').show();
			$('#CustomerLoginEmail','#UserPassword').addClass('error_field');			
		}
		
        if(ch==0){
		    $.ajax({		    
			    url:BASE_URL+'users/login_validate',
				method: "POST",
			    data:{User:{email:email,password:password}},			    
			}).done(function(msg){
				
				var data = jQuery.parseJSON(msg);
				var status = data.status;
				var message = data.message;
				if(status == 'error'){
					
					if(typeof message.email !== 'undefined') {
						$('#user_login_error').html(message.email);
						$('#CustomerLoginEmail').addClass('error_field');
					}else if(typeof message.password !== 'undefined'){
						$('#user_login_error').html(message.password);
						$('#UserPassword').addClass('error_field');
					}else{
						$('#user_login_error').html(message.invalid);
						$('#CustomerLoginEmail','#UserPassword').addClass('error_field');
					}
                    $('#user_login_error').show();				
				}else if(status == 'success'){
				    customerflag = true;
                    $('#CustomerLoginForm').submit();					
				}			    
		    });			
	    }	
	});
	/***********************************END*******************************/
	/*********** Contact Us Form Validate ******************/
	var flag = false;
	
	$('#UserContactUsForm').on('submit',function(event){		
		$('#UserFirstName').removeClass('error_field');
		$('#UserLastName').removeClass('error_field');
		$('#UserContactEmail').removeClass('error_field');
		$('#UserMessage').removeClass('error_field');
		$('#contact_login_error').hide();
		if(flag === true){
			flag = false; 
            return;
		}
		event.preventDefault();
		var ch=0;
		var firstname = $.trim($('#UserFirstName').val());
		var lastname = $.trim($('#UserLastName').val());		
		var email = $.trim($('#UserContactEmail').val());		
		var message = $.trim($('#UserMessage').val());		
		if(firstname==""){
		    $('#contact_login_error').html('Please enter your First Name.');
			$('#contact_login_error').show();
		    $('#UserFirstName').addClass('error_field');
		    ch++;
	    }
		if(lastname==""){
			$('#contact_login_error').html('Please enter your Last Name.');
			$('#contact_login_error').show();
			$('#UserLastName').addClass('error_field');
		    ch++;
	    }
		if(email==""){
			$('#contact_login_error').html('Please enter your Email Address.');
			$('#contact_login_error').show();
			$('#UserContactEmail').addClass('error_field');
			ch++;
		}else if(emailpattern.test(email) != true){
			$('#contact_login_error').html('Please enter valid Email Address.');
			$('#contact_login_error').show();
			$('#UserContactEmail').addClass('error_field');
			ch++;
		}
		if(message==""){
			$('#contact_login_error').html('Please enter your Message.');
			$('#contact_login_error').show();
			$('#UserMessage').addClass('error_field');
			ch++;
		}
		if(email=="" && firstname=="" && lastname=="" && message=="" ){
			$('#contact_login_error').html('Please fill the below fields.');
			$('#contact_login_error').show();
			$('#UserContactEmail','#UserMessage','#UserLastName','#UserFirstName').addClass('error_field');
            ch++;			
		}
		//alert(email + password);
        if(ch==0){		   
				    flag = true;
                    $('#UserContactUsForm').submit();					
				}			    
		    });			
	   
	/***********************************END*******************************/
	
	/*********** Contact Us Popup Form Validate ******************/
	
	
	$('#contactus_popup').on('click',function(event){		
		$('#UserFirstNamePopup').removeClass('error_field');
		$('#UserLastNamePopup').removeClass('error_field');
		$('#UserContactEmailPopup').removeClass('error_field');
		$('#UserMessagePopup').removeClass('error_field');
		$('#contact_error_popup').hide();
		
		var ch=0;
		var firstname = $.trim($('#UserFirstNamePopup').val());
		var lastname = $.trim($('#UserLastNamePopup').val());		
		var email = $.trim($('#UserContactEmailPopup').val());		
		var message = $.trim($('#UserMessagePopup').val());
        if(message==""){
			$('#contact_error_popup').html('Please enter your Message.');
			$('#contact_error_popup').show();
			$('#UserMessagePopup').addClass('error_field');
			ch++;
		}
        if(email==""){
			$('#contact_error_popup').html('Please enter your Email Address.');
			$('#contact_error_popup').show();
			$('#UserContactEmailPopup').addClass('error_field');
			ch++;
		}else if(emailpattern.test(email) != true){
			$('#contact_error_popup').html('Please enter valid Email Address.');
			$('#contact_error_popup').show();
			$('#UserContactEmailPopup').addClass('error_field');
			ch++;
		}
		if(lastname==""){
			$('#contact_error_popup').html('Please enter your Last Name.');
			$('#contact_error_popup').show();
			$('#UserLastNamePopup').addClass('error_field');
		    ch++;
	    }		
		if(firstname==""){
		    $('#contact_error_popup').html('Please enter your First Name.');
			$('#contact_error_popup').show();
		    $('#UserFirstNamePopup').addClass('error_field');
		    ch++;
	    }		
		if(email=="" && firstname=="" && lastname=="" && message=="" ){
			$('#contact_error_popup').html('Please fill the below fields');
			$('#contact_error_popup').show();
			$('#UserContactEmailPopup','#UserMessagePopup','#UserLastNamePopup','#UserFirstNamePopup').addClass('error_field');
            ch++;			
		}
		//alert(email + password);
        if(ch==0){				
                    $('#ContactUsPopupForm').submit();					
				}			    
		    });			
	   
	/***********************************END*******************************/
	
	/*********** Upcoming Courses Filter Search **************************/
	 
	 $('.strtbtn').on('click',function(){
		$('#strttxt').val($(this).attr('id'));
        $('#filtersearch').submit(); 		
	 });
	/***********************************END*******************************/	
	/*********** Training Providers Filter Search ************************/
	 /* $('.trainerfltrfrm').on('click',function(){
        		 
		$('#trainingproviderfltr').submit();
	 }); */
	 $('.trainrsort').on('change',function(){
		var cls = $(this).attr('class');
		$('.'+cls).prop('disabled',true);
		$(this).prop('disabled',false);
        $('#filtersearch').submit(); 		
	 });
	/***********************************END*******************************/		
	/*********** Training Forgot Password ********************************/
    $('#trnrfrgtpswrdanchr').on('click',function(){
		$('.error').html('');
		$('.error_field').each(function(){
			$(this).removeClass('error_field');
		});
		$(this).parent().parent().hide();
		$('#trnrfrgtpswrd').show();
	});
    
    $('#frgtbck').on('click',function(){	
        $('.error').html('');
        $('.error_field').each(function(){
			$(this).removeClass('error_field');
		});		
		$(this).parent().parent().parent().hide();
		$(this).parent().parent().parent().prev('div.log_in').show();
	});	
	
	$('#frgtreset').on('click',function(){
		$('#TrainerResetPasswordEmail').removeClass('error_field');
		$('#login_error').hide();
		var ch=0;
		var email = $.trim($('#TrainerResetPasswordEmail').val());				
		if(email==""){
		    $('#login_error').html('Please enter an email.');
			$('#login_error').show();
		    $('#TrainerResetPasswordEmail').addClass('error_field');
		    ch++;
	    }		
        if(ch==0){
		    $.ajax({		    
			    url:BASE_URL+'trainers/email_validate',
				method: "POST",
			    data:{Trainer:{email:email}},			    
			}).done(function(msg){
				
				var data = jQuery.parseJSON(msg);
				var status = data.status;
				var message = data.message;
				if(status == 'error'){					
					if(typeof message.email !== 'undefined') {
						$('#login_error').html(message.email);
					}else{
						$('#login_error').html(message.invalid);
					}
                    $('#login_error').show();				
				}else if(status == 'success'){
				    //trainerflag = true;
                    $('#TrainerForgotPasswordForm').submit();					
				}			    
		    });			
	    }
	});
	
	/***********************************END******************************************/		
	/************************* Customer Forgot Password *****************************/
    
	$('#cstmrfrgtpswrdanchr').on('click',function(){
		$('.error').html('');
		$('.error_field').each(function(){
			$(this).removeClass('error_field');
		});
		$(this).parent().parent().hide();
		$('#cstmrfrgtpswrd').show();
	});
	
    $('body').on('keyup','.error_field',function(){		    
		    $(this).removeClass('error_field');
			
	    });
	$('body').on('change','.error_field',function(){		    
		    $(this).removeClass('error_field');
			
	    });
	
    $('#cstmrfrgtbck').on('click',function(){
         $('.error').html('');	
        $('.error_field').each(function(){
			$(this).removeClass('error_field');
		});		 
		$(this).parent().parent().parent().hide();
		$(this).parent().parent().parent().prev('div.log_in').show();
	});	
	
	$('#cstmrfrgtreset').on('click',function(){
		$('#CustomerResetPasswordEmail').removeClass('error_field');
		$('#user_login_error').hide();
		var ch=0;
		var email = $.trim($('#CustomerResetPasswordEmail').val());				
		if(email==""){
		    $('#user_login_error').html('Please enter an email.');
			$('#user_login_error').show();
		    $('#CustomerResetPasswordEmail').addClass('error_field');
		    ch++;
	    }		
        if(ch==0){
		    $.ajax({		    
			    url:BASE_URL+'trainers/email_validate',
				method: "POST",
			    data:{User:{email:email}},			    
			}).done(function(msg){
				
				var data = jQuery.parseJSON(msg);
				var status = data.status;
				var message = data.message;
				if(status == 'error'){					
					if(typeof message.email !== 'undefined') {
						$('#user_login_error').html(message.email);
					}else{
						$('#user_login_error').html(message.invalid);
					}
                    $('#user_login_error').show();				
				}else if(status == 'success'){
				    //trainerflag = true;
                    $('#CustomerForgotPasswordForm').submit();					
				}			    
		    });			
	    }
	});
	
	/***********************************END******************************************/	
	/************************* Edit Course SubCategory List *****************************/
	
	$('#CourseEditCategoryId').on('change',function(){
		var e = $(this).val();
		//alert(e);
		$.ajax({
			method:'POST',
			url: BASE_URL+'courses/substr_categorylist',
			data:{category_id:e},			
		}).done(function(res){
			$('#subcategory').html(res);
		});
	});
	
	/***********************************END******************************************/
	/************************* Seminar SubCategory List *****************************/
	
	$('#SeminarEditCategoryId').on('change',function(){
		var e = $(this).val();
		//alert(e);
		$.ajax({
			method:'POST',
			url: BASE_URL+'seminars/sub_categorylist',
			data:{category_id:e},			
		}).done(function(res){
			$('#subcategory').html(res);
		});
	});
	
	/***********************************END******************************************/

	/************************* Edit Course Duration  Calculation *****************************/
	
	/* $('.edit_course_date').on('change',function(){
				var strt_date_day = $('#edit_course_strt_dateDay').val();
				var strt_date_month = $('#edit_course_strt_dateMonth').val();
				var strt_date_year = $('#edit_course_strt_dateYear').val();
				var strt_date = strt_date_year+'-'+strt_date_month+'-'+strt_date_day; 
				var end_date_day = $('#edit_course_end_dateDay').val();
				var end_date_month = $('#edit_course_end_dateMonth').val();
				var end_date_year = $('#edit_course_end_dateYear').val();
				var end_date = end_date_year+'-'+end_date_month+'-'+end_date_day;
				
				//alert('xccvbcvb');
				
				var res = date_diff(strt_date,end_date,'days');
				 
				//alert(res);
				if((res != NaN) && (res != undefined)){
					res = humanise(res); 
					//$('#course_duration').removeProp('disabled');
					//alert(res);
					$('#course_duration').html(res);
					//$('#course_duration').prop('disabled',true);
				}else{
					alert('Invalid date selected. Please select different Date');
				}
				
			}); */
			
    /***********************************END******************************************/
	/******************************** Text Editor Code ***************************************/
	 $('div.clone').each(function(){
				$(this).niceScroll({cursorcolor:"#405E73",cursorwidth:"7px"});
	}); 
			
	$('.clone').on('keyup',function(){
		var cntnt = $(this).html();
		$(this).next('input').val(cntnt);
	});
	
	$('.font_style').click(function(){
		//alert('kdfhgk');
        var cls = $(this).attr('class');
        if(cls == 'font_style act'){
			var removeElements = function(text, selector) {
                                    var wrapped = $("<div>" + text + "</div>");
                                    wrapped.find(selector).contents().unwrap();
                                    return wrapped.html();
                                }
			$(this).removeClass('act');			
			var style = $(this).attr('rel');                   			
			var text = $(this).parent().prev('div .font_defind').find('div.textarea-wrapper input').val();			
			if(style == 'italic'){
				var new_text = removeElements(text, "i");
			}
			if(style == 'bold'){
				var new_text = removeElements(text, "b");
			}
			if(style == 'underline'){
				var new_text = removeElements(text, "u");
			}
					
			$(this).parent().prev('div .font_defind').find('div.textarea-wrapper input').val(new_text);
			$(this).parent().prev('div .font_defind').find('div.clone').html(new_text);
										
		}else{
			$(this).addClass('act');			
			var style = $(this).attr('rel');                    				
			var text = $(this).parent().prev('div .font_defind').find('div.textarea-wrapper input').val();
			var new_text = '';
					
			if(style == 'italic'){
				new_text = "<i>"+ text +"</i>";
			}
			if(style == 'bold'){
				new_text = "<b>"+ text +"</b>";
			}
			if(style == 'underline'){
				new_text = "<u>"+ text +"</u>";
			}
			$(this).parent().prev('div .font_defind').find('div.textarea-wrapper input').val(new_text);
			$(this).parent().prev('div .font_defind').find('div.clone').html(new_text);
					
		}				
               
	});
	
	/***********************************END******************************************/	
	/*********** Filter Search for advanced search **************************/
	 
	 
	 $('.searchsort').on('change',function(){
		
		var cls = $(this).attr('class');
		$('.'+cls).prop('disabled',true);
		$(this).prop('disabled',false);
        $('#filtersearch').submit(); 		
	 });
	 
	 $('body').on('change','.pricefltr',function(){
	    $('#filtersearch').submit(); 	
	 });
	 
	/***********************************END*******************************/
	
	
	
	
	/*********** Course Providers Filter Search ************************/
	 /* $('.coursefltr').on('click',function(){
        		 
		$('#courseproviderfltr').submit();
	 }); */
	 $('.coursesort').on('change',function(){
		var cls = $(this).attr('class');
		$('.'+cls).prop('disabled',true);
		$(this).prop('disabled',false);
		
        $('#filtersearch').submit(); 		
	 });
	/***********************************END*******************************/	
	
	
	/*********** Seminar  Filter Search ************************/
	
	 $('.seminarsort').on('change',function(){
		var cls = $(this).attr('class');
		$('.'+cls).prop('disabled',true);
		$(this).prop('disabled',false);
        $('#filtersearch').submit(); 		
	 });
	/***********************************END*******************************/	
	
	/**********************start rating***************/
	$(function ()
	{
		$('.rating').rating();
	});
	
	$('body').on('click','.starpopup',function(){
		var slug = $(this).attr('id');
		$.ajax({
			method:'POST',
			url: BASE_URL+'courses/detailrating',
			data:{slug:slug},			
		}).done(function(res){
			$('.contant_boxpop').html(res);
			$(".rating_elmnt").each(function() {
				//alert('dsfd');
				$(this).rating();
			});			
			$('#rating_box').fadeIn(1000);
	    
			//$('#subcategory').html(res);
		});
	});
	$('body').on('click','.starpopup_trainer',function(){
		var slug = $(this).attr('id');
		$.ajax({
			method:'POST',
			url: BASE_URL+'courses/detailrating_trainer',
			data:{slug:slug},			
		}).done(function(res){
			$('.contant_boxpop').html(res);
			$(".rating_elmnt").each(function() {
				//alert('dsfd');
				$(this).rating();
			});			
			$('#rating_box').fadeIn(1000);
	    
			//$('#subcategory').html(res);
		});
	});
	/**********************end rating************************/
	/********************** Customer Comment Section ********/
	
	$('.txt-edit').click(function(){
		//alert($(this).closest('div.text_action').siblings('textarea').attr('id'));
		$(this).closest('div.text_action').siblings('textarea').prop('disabled',false);
		$(this).closest('div.textarea_container').find('textarea').focus();
		$(this).hide();
		$('.txt-cancel').show();
	});
	$('.txt-cancel').click(function(){
		//alert($(this).closest('div.text_action').siblings('textarea').attr('id'));
		$(this).closest('div.text_action').siblings('textarea').prop('disabled',true);
		$(this).hide();
		$('.txt-edit').show();
	});
	
	$('.txt-delete').click(function(e){
		var result = window.confirm('Are you sure you wish to delete this comment?');
            if (result == true) {
                var id = $(this).attr('id');
		        cntct = $(this);
		        $.ajax({
			        method:'POST',
			        url: BASE_URL+'users/delete_comment',
			        data:{id:id},			
		        }).done(function(res){
			        if(res == 'success'){				
				        cntct.parents('div.text_action').siblings('textarea').html('');				
				        cntct.closest('div.text_action').siblings('textarea').prop('disabled',false);		        
				        cntct.parents('div.text_action').remove();
			        }else{
				        alert('Something Went Wrong.Please tryagain Later.');
			        }
			
		        });
            }	
		
	});
	/******************************  PlaceList  **************************************/
	$('.townlistcls').on('change',function(){
		var e = $(this).val();
		var alias = $(this).attr('id');
		//alert(e);
		$.ajax({
			method:'POST',
			url: BASE_URL+'towns/townplacelist',
			data:{town_id:e,alias:alias},			
		}).done(function(res){
			$('#place').html(res);
		});
	});
	/**************************************** END ***********************************/
	/******************************  Location Search  **************************************/
	$('body').on('click','.location_fltr',function(){
        		 
		$('#MapLocationFilterForm').submit();
	});
	 $('.a1').on('click',function(){
			 var cls = $(this).attr('class');
			 $('.'+cls).children('a').removeClass('active');
			 $(this).children('a').addClass('active');
			var id = $(this).attr("id").match(/\d+/);
			$.ajax({		    
			    url:BASE_URL+'locations/location_courses',
				method: "POST",
			    data:{id:id},			    
			}).done(function(msg){
				window.history.pushState("object or string", "Title", "/map?Town="+id+"#city");
				$('#town').html(msg);
				$('.location_rating').rating();
			});
		 });
	/**************************************** END ***********************************/
	
	/*********** Contact Us Popup Form Validate ******************/
	
	
	$('#custmr_register').on('click',function(event){		
		$('#UserRegisterEmailPopup').removeClass('error_field');
		$('#UserRegisterPasswordPopup').removeClass('error_field');		
		$('#rgstr_error_popup').hide();
		
		var ch=0;		
		var password = $.trim($('#UserRegisterPasswordPopup').val());		
		var email = $.trim($('#UserRegisterEmailPopup').val());		
        if(password==""){
			$('#rgstr_error_popup').html('Please enter Password.');
			$('#rgstr_error_popup').show();
			$('#UserRegisterPasswordPopup').addClass('error_field');
			ch++;
		}
        if(email==""){
			$('#rgstr_error_popup').html('Please enter your Email Address.');
			$('#rgstr_error_popup').show();
			$('#UserRegisterEmailPopup').addClass('error_field');
			ch++;
		}else if(emailpattern.test(email) != true){
			$('#rgstr_error_popup').html('Please enter valid Email Address.');
			$('#rgstr_error_popup').show();
			$('#UserRegisterEmailPopup').addClass('error_field');
			ch++;
		}				
		if(email=="" && password=="" ){
			$('#rgstr_error_popup').html('Please Fill the below Fields.');
			$('#rgstr_error_popup').show();
			$('#UserRegisterEmailPopup','#UserRegisterPasswordPopup').addClass('error_field');
            ch++;			
		}
		//alert(email + password);
        if(ch==0){				
                   $.ajax({		    
			            url:BASE_URL+'users/registr_validate',
				        method: "POST",
			            data:{User:{email:email,password:password}},			    
			        }).done(function(msg){
				        var data = jQuery.parseJSON(msg);
				        var status = data.status;
				        var message = data.message;
				        if(status == 'error'){
					
					        if(typeof message.email !== 'undefined') {
						        $('#rgstr_error_popup').html(message.email);
						        $('#UserRegisterEmailPopup').addClass('error_field');
					        }else{
						        $('#rgstr_error_popup').html(message.invalid);
						        $('#UserRegisterEmailPopup').addClass('error_field');
					        }
                            $('#rgstr_error_popup').show();				
				        }else if(status == 'success'){				            
                            $('#RegisterPopupForm').submit();					
				        }
			        });					
				}			    
		    });			
	   
	/***********************************END*******************************/
	
	
	/*********** Contact Us Popup Form Validate ******************/
	
	
	$('.cmplt_rgstration').on('click',function(event){
        //alert('dfsgf');		
        $('#AfterRegisterFirstName').removeClass('error_field');
		$('#AfterRegisterLastName').removeClass('error_field');		
		$('#AfterRegisterTelephone').removeClass('error_field');		
		$('#AfterRegisterAddressLine1').removeClass('error_field');		
		$('#AfterRegisterAddressLine2').removeClass('error_field');		
		$('.AfterRegisterTown').removeClass('error_field');		
		$('#aftrrgstr_error_popup').hide();
		
		var ch=0;		
		var firstname = $.trim($('#AfterRegisterFirstName').val());		
		var lastname = $.trim($('#AfterRegisterLastName').val());		
		var telephone = $.trim($('#AfterRegisterTelephone').val());		
		var addressline1 = $.trim($('#AfterRegisterAddressLine1').val());		
		var addressline2 = $.trim($('#AfterRegisterAddressLine2').val());		
		var town = $.trim($('.AfterRegisterTown').val());		
		var place = $.trim($('#UserPlaceId').val());		
		var email = $.trim($('#AfterRegisterEmail').val());		
        if(email==""){
			$('#aftrrgstr_error_popup').html('Please Fill the below Fields.');
			$('#aftrrgstr_error_popup').show();
			$('#AfterRegisterEmail').addClass('error_field');
			ch++;
		}else if(emailpattern.test(email) != true){
			$('#aftrrgstr_error_popup').html('Please Fill the below Fields.');
			$('#aftrrgstr_error_popup').show();
			$('#AfterRegisterEmail').addClass('error_field');
			ch++;
		}		
        if(town==""){
			$('#aftrrgstr_error_popup').html('Please Fill the below Fields.');
			$('#aftrrgstr_error_popup').show();
			$('.AfterRegisterTown').addClass('error_field');
			ch++;
		}
		if(place==""){
			$('#aftrrgstr_error_popup').html('Please Fill the below Fields.');
			$('#aftrrgstr_error_popup').show();
			$('#UserPlaceId').addClass('error_field');
			ch++;
		}
       
        if(addressline1==""){
			$('#aftrrgstr_error_popup').html('Please Fill the below Fields.');
			$('#aftrrgstr_error_popup').show();
			$('#AfterRegisterAddressLine1').addClass('error_field');
			ch++;
		}	
        if(telephone==""){
			$('#aftrrgstr_error_popup').html('Please Fill the below Fields.');
			$('#aftrrgstr_error_popup').show();
			$('#AfterRegisterTelephone').addClass('error_field');
			ch++;
		}
		if(lastname==""){
			$('#aftrrgstr_error_popup').html('Please Fill the below Fields.');
			$('#aftrrgstr_error_popup').show();
			$('#AfterRegisterLastName').addClass('error_field');
			ch++;
		}
		if(firstname==""){
			$('#aftrrgstr_error_popup').html('Please Fill the below Fields.');
			$('#aftrrgstr_error_popup').show();
			$('#AfterRegisterFirstName').addClass('error_field');
			ch++;
		}
		
		
		if(email=="" && firstname=="" && lastname=="" && telephone=="" && addressline1==""  && town=="" && place==""){
			$('#aftrrgstr_error_popup').html('Please Fill the below Fields.');
			$('#aftrrgstr_error_popup').show();
			$('#AfterRegisterFirstName','#UserPlaceId','#AfterRegisterLastName','#AfterRegisterTelephone','#AfterRegisterAddressLine1','.AfterRegisterTown','#AfterRegisterEmail').addClass('error_field');
            ch++;			
		}
		//alert(email + password);
        if(ch==0){				
                   $.ajax({		    
			            url:BASE_URL+'users/aftr_register',
				        method: "POST",
			            data:{User:{email:email,name:firstname,last_name:lastname,phone:telephone,address_line1:addressline1,address_line2:addressline2,town_id:town,place_id:place,validate:'yes'}},			    
			        }).done(function(msg){
				        var data = jQuery.parseJSON(msg);
				        var status = data.status;
				        var message = data.message;
				        if(status == 'error'){
					        if(typeof message.phone !== 'undefined') {
						        $('#aftrrgstr_error_popup').html(message.phone);
						        $('#AfterRegisterTelephone').addClass('error_field');
					        }else if(typeof message.name !== 'undefined') {
						        $('#aftrrgstr_error_popup').html(message.name);
						        $('#AfterRegisterFirstName').addClass('error_field');
					        }else if(typeof message.last_name !== 'undefined') {
						        $('#aftrrgstr_error_popup').html(message.last_name);
						        $('#AfterRegisterLastName').addClass('error_field');
					        }else if(typeof message.address_line1 !== 'undefined') {
						        $('#aftrrgstr_error_popup').html(message.address_line1);
						        $('#AfterRegisterAddressLine1').addClass('error_field');
					        }else if(typeof message.town_id !== 'undefined') {
						        $('#aftrrgstr_error_popup').html(message.town_id);
						        $('.AfterRegisterTown').addClass('error_field');
					        }else if(typeof message.place_id !== 'undefined'){
						        $('#aftrrgstr_error_popup').html(message.place_id);
						        $('#UserPlaceId').addClass('error_field');
					        }
                            $('#aftrrgstr_error_popup').show();				
				        }else if(status == 'success'){				            
                            $('#UserAfterFormRegister').submit();					
				        }
			        });					
				}		    
		    });			
	   
	/***********************************END*******************************/
	/*******************************iCheck*********************************/
	$('.left_check_nav input').on('ifChecked', function(event){
	      $('#filtersearch').submit();
		 
		}).on('ifUnchecked', function(event){
			//alert($(this).attr('class'));
		$(this).parent().parent().next('.second_cell').find('input[type="checkbox"]:checked').prop('checked', false);
		$('#filtersearch').submit();
		
		});
	/******************************iCheckEND***********************************/
	
});
    /*********************************************************************************
                              Several Functions
    /********************************************************************************/
	$(function(){
		if ( document.location.href.indexOf('#popup_box') > -1 ) {		
            $('#login').click();
        }
		if ( document.location.href.indexOf('#after_register') > -1 ) {		
            $('#afterregisterpopup_box').fadeIn(2000);
        }
		if ( document.location.href.indexOf('#success_box') > -1 ) {		
            $('#success_box').fadeIn(2000);
        }
		$('#success_BoxClose').click(function(){
			$('#success_box').hide();
		});
	});
	
	/************************* Date Diff Function *****************************/
	
	    function date_diff(strt,end,interval){
				var second=1000, minute=second*60, hour=minute*60, day=hour*24, week=day*7;
                date1 = new Date(strt);
                date2 = new Date(end);
                var timediff = date2 - date1;
				//alert(timediff);
                if (isNaN(timediff)) return NaN;
                switch (interval) {
                    case "years"    : return date2.getFullYear() - date1.getFullYear();
                    case "months"   : return (( date2.getFullYear() * 12 + date2.getMonth())  - (date1.getFullYear() * 12 + date1.getMonth() ) );
                    case "weeks"    : return Math.floor(timediff / week);
                    case "days"     : return Math.floor(timediff / day); 
                    case "hours"    : return Math.floor(timediff / hour); 
                    case "minutes"  : return Math.floor(timediff / minute);
                    case "seconds"  : return Math.floor(timediff / second);
                    default         : return undefined;
                }
		}
		
	function humanise (diff) {
        // The string we're working with to create the representation
        var str = '';
        // Map lengths of `diff` to different time periods
        var values = {
            ' year': 365, 
            ' month': 30, 
            ' day': 1
        };
        // Iterate over the values...
        for (var x in values) {
            var amount = Math.floor(diff / values[x]);
            // ... and find the largest time value that fits into the diff
            if (amount >= 1) {
                // If we match, add to the string ('s' is for pluralization)
                str += amount + x + (amount > 1 ? 's' : '') + ' ';
                // and subtract from the diff
                diff -= amount * values[x];
            }
        }

        return str;
    }
		
	/***********************************END******************************************/
	
	
