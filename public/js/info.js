

jQuery(document).ready(function( $ ) {
    
      $( ".btn_purp" ).click(function() {   
      $("#lightSlider").css('width', '100%');
      $("#lightSlider").css('height', '100%');
      $(".active").css('width', '100%');
      $(".active").css('height', '100%');
     });

	//$( "#hostChild" ).submit(function( event ) {
    //    $( "#host-child" ).hide();
    //    $( "#num_1" ).hide();
    //    $('#spanid').html('<img class="yellow-check" src="/front/img/CheckIcon-yellow.png">');
    //    $( "#date-location" ).show();
    //    $("#stage-1").css("background-color", "#4444ce");
    //    $("#stage-1 p").css("color", "#fff");
   //     event.preventDefault();
   //     document.getElementById('page').value = 2;
    //});
    
   // $( "#dateLocation" ).submit(function( event ) {
   //     $( "#date-location" ).hide();
   //     $( "#page-link" ).show();
   //     $( "#num_2" ).hide();
   //     $('#spanid1').html('<img class="yellow-check" src="/front/img/CheckIcon-yellow.png">');
   //     $("#stage-2").css("background-color", "#4444ce");
   //     $("#stage-2 p").css("color", "#fff");
   //     event.preventDefault();
   //     document.getElementById('page').value = 3;
   // });
    
    //$( "#pageLink" ).submit(function( event ) {
    //    $( "#page-link" ).hide();
    //    $( "#congratulations" ).show();
    //    $( "#num_3" ).hide();
   //     $( "#num_4" ).hide();
   //     $('#spanid2').html('<img class="yellow-check" src="/front/img/CheckIcon-yellow.png">');
   //     $('#spanid3').html('<img class="yellow-check" src="/front/img/CheckIcon-yellow.png">');
   //     $("#stage-3").css("background-color", "#4444ce");
   //     $("#stage-3 p").css("color", "#fff");
   //     $("#stage-4").css("background-color", "#4444ce");
   //     $("#stage-4 p").css("color", "#fff");
   //     event.preventDefault();
   //     document.getElementById('page').value = 4;
   // });
   
   jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetical characters"); 
   
   $("#congrats").validate({
	        ignore: [],
	        highlight: function (element) {
	            $(element).parent('div').addClass('has-error');
	        },
	        unhighlight: function (element) {
	            $(element).parent('div').removeClass('has-error');
	        },
	        errorClass: 'help-block help-block-error',
	        errorElement: 'div',
	        rules: {
				host_name: {required: true, lettersonly: true},
				child_fname: {required: true, lettersonly: true},
				dob: {required: true},
				your_link: {required: true, pattern: /^[A-Za-z\d-.]+$/},
			},
			messages: {
			    host_name: {lettersonly: "Please Enter Valid Name"},
			    child_fname: {lettersonly: "Please Enter Valid Name"},
			    your_link: {pattern: "Please Enter Valid Link"},
			},
	        errorPlacement: function (error, element) {         
	                error.insertAfter(element);           
	        },
	        success: function (element) {
	            $(element).parent('.form-group').removeClass('has-error');
        	}
		});
   
   $(window).on('popstate', function(e){
        var pathname = window.location.pathname;
        switch(pathname) {
            case '/parent-child-info':
                $( "#host-child" ).show();
                $( "#date-location" ).hide();
                $( "#page-link" ).hide();
                $( "#congratulations" ).hide();
                $( "#num_1" ).show(); 
                $( "#spanid" ).hide();
                $( "#num_2" ).show(); 
                $( "#spanid1" ).hide();
                $( "#num_3" ).show(); 
                $( "#spanid2" ).hide();
                $( "#num_4" ).show(); 
                $( "#spanid3" ).hide();
                $("#stage-1").css("background-color", "WHITE");
                $("#stage-1 a").css("color", "BLACK");
                 $("#stage-2").css("background-color", "WHITE");
                $("#stage-2 a").css("color", "BLACK");
                 $("#stage-3").css("background-color", "WHITE");
                $("#stage-3 a").css("color", "BLACK");
                 $("#stage-4").css("background-color", "WHITE");
                $("#stage-4 a").css("color", "BLACK");
                event.preventDefault();
                break;
            case '/date-location':
                $( "#host-child" ).hide();
                $( "#date-location" ).show();
                $( "#page-link" ).hide();
                $( "#congratulations" ).hide();
                $( "#num_1" ).hide(); 
                $( "#spanid" ).show();
                $( "#num_2" ).show(); 
                $( "#spanid1" ).hide();
                $( "#num_3" ).show(); 
                $( "#spanid2" ).hide();
                $( "#num_4" ).show(); 
                $( "#spanid3" ).hide();
                $("#stage-1").css("background-color", "#4444ce");
                $("#stage-1 a").css("color", "#fff");
                $("#stage-2").css("background-color", "WHITE");
                $("#stage-2 a").css("color", "BLACK");
                 $("#stage-3").css("background-color", "WHITE");
                $("#stage-3 a").css("color", "BLACK");
                 $("#stage-4").css("background-color", "WHITE");
                $("#stage-4 a").css("color", "BLACK");
                if ($( "#not-decided" ).is(":checked")) {
                    $( "#party-time" ).prop( "disabled", true );
                     $( "#party-time" ).removeAttr('value');
                }
                event.preventDefault();
                break;
            case '/page-link':
                $( "#host-child" ).hide();
                $( "#date-location" ).hide();
                $( "#page-link" ).show();
                $( "#congratulations" ).hide();
                $( "#num_1" ).hide(); 
                $( "#spanid" ).show();
                $( "#num_2" ).hide(); 
                $( "#spanid1" ).show();
                $( "#num_3" ).show(); 
                $( "#spanid2" ).hide();
                $( "#num_4" ).show(); 
                $( "#spanid3" ).hide();
                $("#stage-1").css("background-color", "#4444ce");
                $("#stage-1 a").css("color", "#fff");
                $("#stage-2").css("background-color", "#4444ce");
                $("#stage-2 a").css("color", "#fff");
                $("#stage-3").css("background-color", "WHITE");
                $("#stage-3 a").css("color", "BLACK");
                 $("#stage-4").css("background-color", "WHITE");
                $("#stage-4 a").css("color", "BLACK");
                event.preventDefault();
                break;
            case '/congrats':
                $( "#host-child" ).hide();
                $( "#date-location" ).hide();
                $( "#page-link" ).hide();
                $( "#congratulations" ).show();
                $( "#num_1" ).hide(); 
                $( "#spanid" ).show();
                $( "#num_2" ).hide(); 
                $( "#spanid1" ).show();
                $( "#num_3" ).hide(); 
                $( "#spanid2" ).show();
                $( "#num_4" ).hide(); 
                $( "#spanid3" ).show();
                $("#stage-1").css("background-color", "#4444ce");
                $("#stage-1 a").css("color", "#fff");
                $("#stage-2").css("background-color", "#4444ce");
                $("#stage-2 a").css("color", "#fff");
                $("#stage-3").css("background-color", "#4444ce");
                $("#stage-3 a").css("color", "#fff");
                $("#stage-4").css("background-color", "#4444ce");
                $("#stage-4 a").css("color", "#fff");
                event.preventDefault();
                break;
        }
    });
   
   $( "#stage-1" ).click(function() {
        $( "#host-child" ).show();
        $( "#date-location" ).hide();
        $( "#page-link" ).hide();
        $( "#congratulations" ).hide();
        $( "#num_1" ).show(); 
        $( "#spanid" ).hide();
        $( "#num_2" ).show(); 
        $( "#spanid1" ).hide();
        $( "#num_3" ).show(); 
        $( "#spanid2" ).hide();
        $( "#num_4" ).show(); 
        $( "#spanid3" ).hide();
        $("#stage-1").css("background-color", "WHITE");
        $("#stage-1 a").css("color", "BLACK");
         $("#stage-2").css("background-color", "WHITE");
        $("#stage-2 a").css("color", "BLACK");
         $("#stage-3").css("background-color", "WHITE");
        $("#stage-3 a").css("color", "BLACK");
         $("#stage-4").css("background-color", "WHITE");
        $("#stage-4 a").css("color", "BLACK");
        window.history.pushState(null,null,"/parent-child-info");
        event.preventDefault();
   });
   
   $( "#stage-2" ).click(function() {
        $( "#host-child" ).hide();
        $( "#date-location" ).show();
        $( "#page-link" ).hide();
        $( "#congratulations" ).hide();
        $( "#num_1" ).hide();
        $('#spanid').show();
        $( "#num_2" ).show(); 
        $( "#spanid1" ).hide();
        $( "#num_3" ).show(); 
        $( "#spanid2" ).hide();
        $( "#num_4" ).show(); 
        $( "#spanid3" ).hide();
        $("#stage-2").css("background-color", "WHITE");
        $("#stage-2 a").css("color", "BLACK");
         $("#stage-3").css("background-color", "WHITE");
        $("#stage-3 a").css("color", "BLACK");
         $("#stage-4").css("background-color", "WHITE");
        $("#stage-4 a").css("color", "BLACK");
        $( "#date-location" ).show();
        $("#stage-1").css("background-color", "#4444ce");
        $("#stage-1 a").css("color", "#fff");
        if ($( "#not-decided" ).is(":checked")) {
            $( "#party-time" ).prop( "disabled", true );
        }
        window.history.pushState(null,null,"/date-location");
        event.preventDefault();
   });
   
   $( "#stage-3" ).click(function() {
        $( "#host-child" ).hide();
        $( "#date-location" ).hide();
        $( "#page-link" ).show();
        $( "#congratulations" ).hide();
         $( "#num_1" ).hide(); 
        $( "#spanid" ).show();
         $( "#num_2" ).hide(); 
        $( "#spanid1" ).show();
        $( "#num_3" ).show(); 
        $( "#spanid2" ).hide();
        $( "#num_4" ).show(); 
        $( "#spanid3" ).hide();
        $("#stage-1").css("background-color", "#4444ce");
        $("#stage-1 a").css("color", "#fff");
        $("#stage-2").css("background-color", "#4444ce");
        $("#stage-2 a").css("color", "#fff");
        $("#stage-3").css("background-color", "WHITE");
        $("#stage-3 a").css("color", "BLACK");
         $("#stage-4").css("background-color", "WHITE");
        $("#stage-4 a").css("color", "BLACK");
        window.history.pushState(null,null,"/page-link");
        event.preventDefault();
   });
   
   $( "#stage-4" ).click(function() {
        $( "#host-child" ).hide();
        $( "#date-location" ).hide();
        $( "#page-link" ).hide();
        $( "#congratulations" ).show();
         $( "#num_1" ).hide(); 
        $( "#spanid" ).show();
         $( "#num_2" ).hide(); 
        $( "#spanid1" ).show();
         $( "#num_3" ).hide(); 
        $( "#spanid2" ).show();
        $( "#num_4" ).hide(); 
        $( "#spanid3" ).show();
        $("#stage-1").css("background-color", "#4444ce");
        $("#stage-1 a").css("color", "#fff");
        $("#stage-2").css("background-color", "#4444ce");
        $("#stage-2 a").css("color", "#fff");
        $("#stage-3").css("background-color", "#4444ce");
        $("#stage-3 a").css("color", "#fff");
        $("#stage-4").css("background-color", "#4444ce");
        $("#stage-4 a").css("color", "#fff");
        window.history.pushState(null,null,"/congrats");
        event.preventDefault();
   });
   
   $( "#date-location" ).on( "click", "#not-decided", function() {
       if ($(this).is(":checked")) {
        $( "#party-time" ).prop( "disabled", true );
        $( "#party-time" ).val( " ");
        $( "#party-time-error" ).css("display", "none");
       }
       else
        $( "#party-time" ).prop( "disabled", false );
        $( "#party-time-error" ).show();
   });
   
   $('#congrats').on('submit',function(){
       if($(this).valid()) {
       $(this).hide();
       $('#creating').show();
       $('#info-header').text('WE\'RE BUILDING YOUR GIFT PAGE...');
       $("#back").attr("href", "/parent-child-info");
       }
   }) 
    
    $(" #back" ).click(function() {
        window.history.back();
    });
   
   $( "#accN" ).click(function() {
        console.log(window.history.length);
        $( "#acc_name" ).show();
        $( "#acc_email" ).hide().css("font-weight", "normal");
         $( "#acc_priv" ).hide();
         $( "#acc_pass" ).hide();
         $(this).css("font-weight", "bold");
         $( "#accE" ).css("font-weight", "normal");
         $( "#accP" ).css("font-weight", "normal");
         $( "#accCP" ).css("font-weight", "normal");
         $('#success-info').remove();
         $('#alert-password').remove();
         $('#success-alerts').remove();
         $('#success-priv').remove();
         $('#success-password').remove();
    });
   
   $( "#accE" ).click(function() {
      // history.pushState("view");
         $( "#acc_name" ).hide();
        $( "#acc_email" ).show();
         $( "#acc_priv" ).hide();
         $( "#acc_pass" ).hide();
         $(this).css("font-weight", "bold");
         $( "#accN" ).css("font-weight", "normal");
         $( "#accP" ).css("font-weight", "normal");
         $( "#accCP" ).css("font-weight", "normal");
         $('#success-info').remove();
         $('#alert-password').remove();
         $('#success-alerts').remove();
         $('#success-priv').remove();
         $('#success-password').remove();
    });
   
   $( "#accP" ).click(function() {
     //  history.pushState("view");
         $( "#acc_email" ).hide();
          $( "#acc_name" ).hide();
           $( "#acc_pass" ).hide();
        $( "#acc_priv" ).show();
        $(this).css("font-weight", "bold");
        $( "#accN" ).css("font-weight", "normal");
         $( "#accE" ).css("font-weight", "normal");
         $( "#accCP" ).css("font-weight", "normal");
         $('#success-info').remove();
         $('#alert-password').remove();
         $('#success-alerts').remove();
         $('#success-priv').remove();
         $('#success-password').remove();
      
    });
    
    $( "#accCP" ).click(function() {
     //  history.pushState("view");
         $( "#acc_email" ).hide();
          $( "#acc_name" ).hide();
           $( "#acc_priv" ).hide();
        $( "#acc_pass" ).show();
        $(this).css("font-weight", "bold");
        $( "#accN" ).css("font-weight", "normal");
         $( "#accE" ).css("font-weight", "normal");
         $( "#accP" ).css("font-weight", "normal");
         $('#success-info').remove();
         $('#alert-password').remove();
         $('#success-alerts').remove();
         $('#success-priv').remove();
         $('#success-password').remove();
      
    });
    
   
    $('#drag form input').change(function () {
        $('#drag form p').remove();
        $('#photo-form').css("border", "none");
  });
  
  
  $( "#accName" ).submit(function( event ) {

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            
            var fname = $('#first_name').val();
            var lname = $('#last_name').val();
            var email = $('#email').val();
            
            $('#success-info').remove();
            
            $.ajax({
                type:'POST',
                url:'/account/store-info',
                data:{
                    first_name: fname,
                    last_name: lname,
                    email: email
                },
                success:function(data){
                    $('#email-row').after('<div id="success-info" class="alert alert-success form-group col-md-6" style="margin: 10px 0 5px;"><strong>Success!</strong> Your Account info has been saved.</div>');
                },
                error:  function (error) {
                    
                }
        });
    
    });
    
    $( "#accEmail" ).submit(function( event ) {

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
           
            var alerts = 0;
            if ($("#alerts").is(":checked")) {  
                 alerts = 1;
            } 
            
            var fupdates = 0;
            if ($("#updates").is(":checked")) {  
                 fupdates = 1;
            } 
            
            $('#success-alerts').remove();
            
            $.ajax({
                type:'POST',
                url:'/account/alerts',
                data:{
                    gift_alerts: alerts,
                    fynches_updates: fupdates
                },
                success:function(data){
                    $('#update-row').after('<div id="success-alerts" class="alert alert-success form-group col-md-6" style="margin: 10px 0 5px;"><strong>Success!</strong> Your email alerts have been saved.</div>');
                },
                error:  function (error) {
                    
                }
        });
    
    });
    
    $( "#accPriv" ).submit(function( event ) {

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
           
            var google = $("input:radio[name='google']:checked").val();
            var fynches = $("input:radio[name='fynches']:checked").val();
            
            $('#success-priv').remove();
            
            $.ajax({
                type:'POST',
                url:'/account/privacy',
                data:{
                    google_search: google,
                    fynches_search: fynches
                },
                success:function(data){
                    $('#success-row').after('<div id="success-priv" class="alert alert-success form-group col-md-6" style="margin: 10px 0 5px;"><strong>Success!</strong> Your privacy settings have been saved.</div>');
                },
                error:  function (error) {
                    
                }
        });
    
    });
    
    $( "#accPass" ).submit(function( event ) {

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            
            var cpass = $('#cpass').val();
            var npass = $('#npass').val();
            var cnpass = $('#cnpass').val();
            var nocn = $('#no-cn').val();
           
            $('#alert-password').remove();
            $('#success-password').remove();
            
            if (npass != cnpass && nocn != 1) {
                $('#pass-row').after('<div id="alert-password" class="alert alert-danger form-group col-md-6" style="margin: 10px 0 5px;"><strong>Alert!</strong> Confirmation password does not match.</div>');
                return;
            }
            
            
            
            $.ajax({
                type:'POST',
                url:'/account/password',
                data:{
                    cpass: cpass,
                    npass: npass,
                    cnpass: cnpass,
                    nocn: nocn
                },
                success:function(data){
                    
                    if(data.update == 'not-password') {
                        
                    $('#pass-row').after('<div id="success-password" class="alert alert-danger form-group col-md-6" style="margin: 10px 0 5px;"><strong>Alert!</strong> Current password does not match.</div>');
                    
                        
                    } else {
                    
                    $('#pass-row').after('<div id="success-password" class="alert alert-success form-group col-md-6" style="margin: 10px 0 5px;"><strong>Success!</strong> Your Account info has been saved.</div>');
                    
                    }
                },
                error:  function (error) {
                    
                }
        });
    
    });
    
    $( "#hostChild" ).submit(function( event ) {

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            
            var fname = $('#host_fname').val();
            var lname = $('#host_lname').val();
            var child = $('#child_fname').val();
            
            $('#child').data('child', 'test');
       
            var cage = $('#child_age').val();
            
            $('#success-info').remove();
            
            $.ajax({
                type:'POST',
                url:'/account/host-child',
                data:{
                    host_fname: fname,
                    host_lname: lname,
                    child_fname: child,
                    child_age: cage
                },
                success:function(data){
                    $( "#host-child" ).hide();
                    $( "#num_1" ).hide();
                    $('#spanid').show();
                    $('#spanid').html('<img class="yellow-check" src="public/front/img/CheckIcon-yellow.png">');
                    $( "#date-location" ).show();
                    $("#stage-1").css("background-color", "#4444ce");
                    $("#stage-1 a").css("color", "#fff");
                    if ($( "#not-decided" ).is(":checked")) {
                        $( "#party-time" ).prop( "disabled", true );
                    }
                    event.preventDefault();
                },
                error:  function (error) {
                    
                }
        });
    window.history.pushState(null,null,"/date-location");
    });
    
    $( "#dateLocation" ).submit(function( event ) {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        
        var ptime = $('#party-time').val();
        var zipcode = $('#zipcode').val();
        var notready = 0;
        var child = $('#child_fname').val();
        
        if ($("#not-decided").is(":checked")) {  
             notready = 1;
        }
        
        $('#success-info').remove();
        
        $.ajax({
            type:'POST',
            url:'/account/location',
            data:{
                party_time: ptime,
                zip_code: zipcode,
                not_decided: notready,
                child: child
            },
            success:function(data){
                $( "#date-location" ).hide();
                $( "#page-link" ).show();
                $( "#num_2" ).hide();
                $('#spanid1').show();
                $('#spanid1').html('<img class="yellow-check" src="public/front/img/CheckIcon-yellow.png">');
                $("#stage-2").css("background-color", "#4444ce");
                $("#stage-2 a").css("color", "#fff");
                event.preventDefault();
            },
            error:  function (error) {
                
            }
        });
    window.history.pushState(null,null,"/page-link");
    });
  
    $( "#pageLink" ).submit(function( event ) {

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            
            var link = $('#your-link').val();
            var child = $('#child_fname').val();
            var slug = $('#your-link').val();
            var pic_src = $('#picture').attr('src');
             
            $('#congrats').attr('action', 'gift/'+slug); 
            
            $('#success-info').remove();
            
            $.ajax({
                type:'POST',
                url:'/account/gift-link',
                data:{
                    gift_link: link,
                    pic_src:pic_src,
                    child: child
                },
                success:function(data){
                    $( "#page-link" ).hide();
                    $( "#congratulations" ).show();
                    $( "#num_3" ).hide();
                    $( "#num_4" ).hide();
                    $('#spanid2').show();
                    $('#spanid2').html('<img class="yellow-check" src="public/front/img/CheckIcon-yellow.png">');
                    $('#spanid3').show();
                    $('#spanid3').html('<img class="yellow-check" src="public/front/img/CheckIcon-yellow.png">');
                    $("#stage-3").css("background-color", "#4444ce");
                    $("#stage-3 a").css("color", "#fff");
                    $("#stage-4").css("background-color", "#4444ce");
                    $("#stage-4 a").css("color", "#fff");
                    event.preventDefault();
                },
                error:  function (error) {
                    
                }
        });
    window.history.pushState(null,null,"/congrats");
    });
    
     //$('[data-toggle="tooltip"]').tooltip(); 
    
});



